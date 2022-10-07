<x-app-layout title="Department" page="Add Department">

    <form action="{{ route('admin.master.storeDepartment') }}">
        <div class="form-group">
            <div class="input-group">
                <input type="text" class="form-control" oninput="noWhiteSpace(event)" id="department"
                    placeholder="Department Name">
                <div class="input-group-append">
                    <button class="btn btn-sm btn-primary" id="add" onclick="storeDepartment()" type="button">Add</button>
                </div>
            </div>
            <span class="text-red-500" id="error" style="font-size: 12px;"></span>
        </div>
    </form>

    <div class="col-lg-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Departments</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Department</th>
                            </tr>
                        </thead>
                        <tbody id="departmentTable">
                          <tr>
                            <td colspan="2" align="center">
                             <x-spinner/>
                            </td>
                          </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function noWhiteSpace(e) {
        if (e.which === 32)
            return false;
    }
   var index = 0;
    $(document).ready(function() {
        function fetchDepartments() {
            $.ajax({
                type: "get",
                url: "{{ route('admin.master.getDepartments') }}",
                dataType: "json",
                success: function(res) {
                  $("#departmentTable").html("")
                  
                    res.forEach(function(value, i) {
                      index = i+1
                      departmentRow(i, value.department_name)
                    });
                }
            });
        }(fetchDepartments())

    });

    function departmentRow(i, name) {
      $("#departmentTable").append(`
          <tr>
            <td>${i+1}</td>
            <td>${name}</td>
          </tr>
      `)
    }


    function storeDepartment() {
        let dept = $("#department").val()

        if (dept == "" || dept == null || dept == undefined) {
            $("#error").text("Please enter Department")
            return
        } else {
            $("#error").text("")
        }
        $.ajax({
            type: "post",
            url: "{{ route('admin.master.storeDepartment') }}",

            data: {
                department: dept
            },

            dataType: "json",
            beforeSend: function()  {
              $("#add").attr("disabled", "disabled");
            },

            success: function(res) {
              $("#add").removeAttr("disabled");
              toast("Department Added", "success")
              
              departmentRow(index, dept)
              index += 1;
            },

            error: function (error) {
              $("#add").removeAttr("disabled");
              toast(error.responseJSON.message, 'error')
            }
        });
    }

    function toast(title, icon) { //title = Signed in Success
                                  //icon = error, icon = success
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
            icon: icon,
            title: title
        })
    }
</script>
