<!DOCTYPE html>
<html lang="en">
    @include('admin.include.header')
    <body> 
        <div class="page-container">
            @include('admin.include.leftpanel.admin_sidebar')
            <div class="page-content-wrapper">
                <div class="page-content">
                    @yield('content')
                </div>
            </div>    
        </div>
        <div id="deletemodel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="deletemodel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLiveLabel">Delete Record</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-0">Are you sure to delete record ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn  btn-primary yes-sure">Delete</button>
                    </div>
                </div>
            </div>
        </div> 
        @include('admin.include.footer')
    </div>
    <style>
        .has-error {
            border-color: red!important;
            border-width: 1px!important;
        }
        .form-control.error {
            border: 1px solid red!important;
        }
        label.error {
            display: none!important;
        }
    </style>
</body>
</html>