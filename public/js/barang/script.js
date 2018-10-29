$(document).ready(function() {
    //library dataTables
    var dataTablesString = '#dataTables';
    var dataTables = $(dataTablesString).DataTable({
        // lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
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
            style: 'multi',
            selector: 'td:first-child'
        },
        pageLength: 2,
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
    })

        dataTables.button().add(3, {
            attr: {
                id: 'hapussemua',
                style: 'background-color: #f06595',
            },
            text: `<i class="fas fa-eraser fa-lg"></i>`,
        });

        $(`#dataTables_wrapper input[type=search]`).addClass('form-control form-control-sm');

        $('#hapussemua').click( function () {
            console.log($(`${dataTablesString} tbody tr[class *= 'selected']`));
            dataTables.rows('.selected').remove().draw();
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
