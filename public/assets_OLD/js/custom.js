function confirmDelete (e) {
    Swal.fire({
        title: 'Are you sure?',
        text: "Are you sure you want to delete this record?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.value) {
            $formId = $(e).data("form-id");
            $("#"+$formId).submit();
            return true;
        } else {
            return false;
        }
    })
}

$(document).on('click', '.act-delete', function(e) {
        e.preventDefault();

        var action = $(this).attr('href');
        var element = $(this).parents("tr");

        Swal.fire({
            title: 'Are you sure?',
            text: "Are you sure you want to delete this record?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'

        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: action,
                    type: 'POST',
                    dataType: 'json',
                    beforeSend: addOverlay,
                    data: {
                        _token: $('meta[name="csrf_token"]').attr('content')
                    },
                    success: function(result) {
                        if(result === true) {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: result['message'],
                                showConfirmButton: false,
                                timer: 1000
                            });

                            console.log(element);

                            element.remove();
                        }

                    },
                    complete: removeOverlay
                });
                return true;
            } else {
                return false;
            }
        })

    });

// //Remove image
// $(".remove_image").click(function () {
//     var storage_path = $(this).data('storage-path');
//     var thumbnail_id = $(this).data('thumbnail-id');
//     var action = $(this).attr('href');

//     Swal.fire({
//         title: 'Are you sure?',
//         text: "Are you sure you want to delete this record?",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Yes'
//     }).then((result) => {
//         if (result) {
//             deleteImage(action, storage_path, thumbnail_id);
//             $(this).parent().parent().remove();
//         } else {
//             swal("Your imaginary file is safe!");
//         }
//     });

// });

// //Delete image
// function deleteImage(action, storage_path = '', thumbnail_id = 0) {

//     $.ajax({
//         url: action,
//         type: 'DELETE',
//         dataType: 'json',
//         beforeSend: addOverlay,
//         data: {
//             _token: $('meta[name="csrf_token"]').attr('content'),
//             storage_path: storage_path,
//             thumbnail_id: thumbnail_id,
//         },
//         success: function(result) {
//             if(result === 'true') {
//                 Swal.fire({
//                     position: 'center',
//                     icon: 'error',
//                     title: result['message'],
//                     showConfirmButton: false,
//                     timer: 1000
//                 });
//             }
//             return true;
//         },
//         complete: removeOverlay
//     });
// }

function addOverlay() { $('<div id="overlayDocument"></div>').appendTo(document.body); }

function removeOverlay() { $('#overlayDocument').remove(); }

