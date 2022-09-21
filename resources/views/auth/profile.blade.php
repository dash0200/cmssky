<x-app-layout>

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Change Password</h4>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="oldPassword">Old Pasword</label>
                        <x-text-input type="password" name="old_password" id="old_password"
                            placeholder="Current Password" />
                    </div>
                    <div class="form-group col-6">
                    </div>
                    <div class="form-group col-6">
                        <label for="exampleInputPassword4">New Password</label>
                        <x-text-input type="password" name="new_password" oninput="newPass()" id="new_password"
                            placeholder="New Password" />
                        <span id="newError" class="text-danger"></span>
                    </div>
                    <div class="form-group col-6">
                        <label for="exampleInputPassword4">Confirm Password</label>
                        <x-text-input type="password" name="confirm_password" oninput="cnfPassword()"
                            id="confirm_password" placeholder="Confirm Password" />
                        <span id="oldError" class="text-danger"></span>
                    </div>
                    <button onclick="updatePassword()" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light" id="cancel">Cancel</button>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
<script src="{{ asset('sweet-alert.js') }}"></script>
<script>
    $("#cancel").on("click", function(){
        $("#old_password").val("");
        $("#new_password").val("");
        $("#confirm_password").val("");
    })
    var newValid = false;

    function newPass() {
        let newPas = $("#new_password").val();
        if (newPas == '' || newPas == null || newPas == undefined || newPas.length < 8) {
            $("#newError").text("Password must be atleast 8 characters")
            newValid = false;
            return
        } else {
            $("#newError").text("")
            newValid = true;
            cnfPassword()
        }

    }

    var cnfValid = false;

    function cnfPassword() {
        let cnfPass = $("#confirm_password").val();
        if (cnfPass == '' || cnfPass == null || cnfPass == undefined || cnfPass != $("#new_password").val()) {
            $("#oldError").text("Password do not match")
            cnfValid = false
            return
        } else {
            $("#oldError").text("")
            cnfValid = true;
        }
    }

    function updatePassword() {

        if (newValid && cnfValid) {
            $.ajax({
                type: "post",
                url: "{{ route('updatePassword') }}",
                data: {
                    old: $("#old_password").val(),
                    new: $("#new_password").val(),
                    cnf: $("#confirm_password").val()
                },
                dataType: "json",
                success: function(res) {
                    $("#old_password").val("");
                    $("#new_password").val("");
                    $("#confirm_password").val("");

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Password updated'
                    })
                },
                error: function(){
                    $("#old_password").val("");
                    $("#new_password").val("");
                    $("#confirm_password").val("");
                    
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'error',
                        title: 'Old password is wrong',
                        showCancelButton: true
                    })
                }
            });
        }
    }
</script>
