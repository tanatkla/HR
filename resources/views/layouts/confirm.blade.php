@push('script')
    <!--Your JavaScript Assets or Code Goes Here -->

    <script>
        function saveForm(storeUri,FormData){
            axios.post(storeUri,FormData).then(response => {
                        Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            ).then(function() {
                                location.reload();
                            });
                    })
        }

        $(".ConfirmRecord").click(function() {
            var id = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");
            var route_delete = $(this).attr('data-route-delete');


            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Disapprove'
            }).then((result) => {
                if (result.isConfirmed) {
                    var id = $(this).data("id");
                    var token = $("meta[name='csrf-token']").attr("content");
                    let storeUri = "{{ $store_uri }}"
                    var formData = new FormData(document.querySelector('#save-form'));
                    var status_check = $(this).attr("value")
                    formData.append('status', status_check);
                    // console.log(formData, storeUri, status_check );
                    // console.log($(this).attr("value"))
                    // $.ajax({
                    //     url: route_delete,
                    //     type: 'POST',
                    //     data: {
                    //         "id": id,
                    //         "_token": token,
                    //         "formData" : formData,
                    //     },
                    //     success: function() {
                    //         Swal.fire(
                    //             'Deleted!',
                    //             'Your file has been deleted.',
                    //             'success'
                    //         ).then(function() {
                    //             location.reload();
                    //         });
                    //     }
                    // });
                  saveForm(storeUri, formData);
                }
            });

        });
    </script>
@endpush
