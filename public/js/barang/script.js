$(document).ready(function() {
    //library dataTables
    var dataTablesString = '#dataTables';
    var dataTablesParams = {
         lengthMenu: [[10, 25, 50, -1], ['10 baris', '25 baris', '50 baris', "All"]],
        columnDefs:[
            {
                targets: 0,
                orderable: false,
                className: 'select-checkbox',
                checkboxes: {
                    selectRow: true
                }
            },
            {
                targets: [0,5,6],
                orderable: false,
            }
        ],
        select:{
            style: 'multiple',
            selector: 'td:first-child',
        },
        pageLength: 5,
        dom:'Bfrtip',
        buttons: [
            {
                extend: "print",
                exportOptions: {columns: [1,2,3,4]},
                text: `<i class='fas fa-print fa-lg'></i>`,
                attr: {
                    style:'background-color:#339af0;'
                }

            },
            {
                extend: "excelHtml5",
                exportOptions: {columns: [1,2,3,4]},
                text: `<i class='far fa-file-excel fa-lg'></i>`,
                attr: {
                    style:'background-color:#51cf66;'
                }
            },
            {
                extend: "pdfHtml5",
                exportOptions: {
                    columns: [0,1,2,3]
                },
                text: `<i class='far fa-file-pdf fa-lg'></i>`,
                attr: {
                    style:'background-color:#ff922b;'
                },

            },
            {
                extend: "colvis",
                text: `<i class='far fa-eye-slash fa-lg'></i>`,
                attr: {
                    style:'background-color:#845ef7;'
                }

            },
            {
                extend: "pageLength",
                text: `Baris`,
                attr: {
                    style:'background-color:#6c757d; font-weight:bold;',
                    class:'dt-button ui-button ui-state-default ui-button-text-only btn-default'
                }
            },

        ],
        language: {
            lengthMenu: "Menampilkan _MENU_ hasil per halaman",
            zeroRecords: "Tidak ditemukan",
            info: "Menampilkan _PAGE_ dari _PAGES_",
            infoEmpty: "Tidak ada data ditemukan",
            infoFiltered: "(Di filter dari total _MAX_ hasil)",
            search:"<label>Cari: <label>",
            searchPlaceholder: "Nama, harga, stok...",
            paginate: {
                previous:"Sebelumnya",
                next: "Selajutnya",
                last: "Halaman terakhir"
            },
            select:{
                rows:"%d baris telah dipilih"
            }
        }
    }

    function dataTables(dataTablesString, dataTablesParams){
        var dataTables = $(dataTablesString).DataTable(dataTablesParams);

        dataTables.button().add(3, {
            attr: {
                id: 'hapussemua',
                style: 'background-color: #f06595',
            },
            text: `<i class="fas fa-eraser fa-lg"></i>`,
        });

        $(`#dataTables_wrapper input[type=search]`).addClass('form-control form-control-sm');
    }

    dataTables(dataTablesString, dataTablesParams);

        var data = null;
        $('#hapussemua').click( function () {
            $('#dataTables tbody tr.selected').remove();
        });

        $("#addBarang").click(function(event) {
            //
            location.href = '/admin/barang/create'
        });
        $("#showBarang").click(function(event) {
            //
            location.href = '/admin/barang'
        });
        $("#loadBarang").click(function(event) {
            //
            var This = $(this);
            This.toggleClass('fa-spin');

            if(This.hasClass('fa-spin'))
            {
                $(dataTablesString).DataTable().destroy();
                $('#dataTables tbody tr').remove()

                $.ajax({
                    url: '/admin/barang/loadBarang',
                    success: function(data)
                    {
                        var data = $.parseJSON(data);
                        var token = data.token;

                        var iteration = 1;
                        $.each(data, function(index, el){
                            console.log(el.nama);
                            var html = `
                                <tr>
                                    <td></td>
                                    <td>${iteration++}</td>
                                    <td>${el.nama}</td>
                                    <td>${el.harga_jual}</td>
                                    <td>${el.stok}</td>
                                    <td>
                                        <button
                                        class="btn btn-default btn-sm btn-gambar"
                                        data-toggle="modal"
                                        data-target="#gambarModal"
                                        data-local="#carousel-generic"
                                        data-link="${el.gambar}"
                                        data-gambar-nama="${el.nama}">
                                       <i class="far fa-eye"></i> Show
                                   </button>
                                    </td>
                                    <td>
                                        <span class="btn-group btn-group-sm">
                                       <a href="/admin/barang/${el.id}/edit" class="btn btn-primary btn-sm">
                                           <i class="far fa-edit"></i>
                                       </a>
                                       <form id="formDelete" action="/admin/barang/${el.id}" method="post">
                                           <input type="hidden" name="_token" value="${data.token}">
                                           <input type="hidden" name="_method" value="DELETE">
                                       </form>
                                       <button form="formDelete" class="btn btn-danger btn-sm btn-delete" type="submit" data-token="${data.token}" data-nama="${el.nama}"> <i class="far fa-trash-alt"></i>

                                   </button>

                                   </span>
                                    </td>
                                </tr>
                            `;

                            $('#dataTables tbody').append(html);
                        })

                        dataTables(dataTablesString, dataTablesParams);
                    }
                })
            }
        });

    //library sweetalert
    $('.btn-delete').click(function(event){
        event.preventDefault();
        swal({
              title: `Hapus data ${$(this).attr('data-nama')} ?`,
              text: "Data yang dihapus akan hilang selamanya!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya, hapus!',
              cancelButtonText: 'Batal'
            }).then((result) => {
              if (result.value) {
                $.ajax({
                    url: $('#formDelete').attr('action'),
                    data: {
                        '_token': $(this).attr('data-token'),
                        '_method': 'DELETE'
                    },
                    type: 'POST',
                    success: function(data){
                            swal(
                                  'Dihapus!',
                                  'Data telah dihapus.',
                                  'success'
                              );
                        location.reload();
                    }
                })
              }
            })
    });

    //script untuk menampilkan gambar di modal
    $('.btn-gambar').click(function(){
        $('#gambarItem').empty();
        $('#dataGambarNama').text($(this).attr('data-gambar-nama'));
        var This = $(this);

        var dataLink = $.parseJSON($.parseJSON(JSON.stringify($(this).attr('data-link'))));
        var width = '100%';
        var height = '100%';

        console.log(dataLink);
        console.log(dataLink.url[0]);
        $.each(dataLink.url, function(index, el) {
            var active = index == 0? 'active':'';
            var item = `
                <div class="carousel-item ${active}">
                    <img src="${el}" alt="${el}" style='width:${width}; height:${height}'>
                    <div class="carousel-caption">
                        ${This.attr('data-gambar-nama')}
                    </div>
              </div>
            `;

            $('#gambarItem').append(item);
        });
    });
});
