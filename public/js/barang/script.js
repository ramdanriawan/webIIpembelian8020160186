

$(document).ready(function() {


    //library dataTables
    var datatables = $('#dataTables').DataTable({
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
                targets: [0,4,5],
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
                extend: "excelHtml5",
                exportOptions: {columns: [0,1,2,3]},
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
                    style:'background-color:#9185B4;'
                }

            },
        ],
        language: {
            lengthMenu: "Menampilkan _MENU_ hasil per halaman",
            zeroRecords: "Tidak ditemukan",
            info: "Menampilkan _PAGE_ dari _PAGES_",
            infoEmpty: "Tidak ada data ditemukan",
            infoFiltered: "(Di filter dari total _MAX_ hasil)",
            search:"Cari: ",
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

    $('#hapussemua').click(function(event) {
        var selectedRows = datatables.rows({ selected: true }).ids(true);
        console.log(selectedRows);
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
              confirmButtonText: 'Ya, hapus!'
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
