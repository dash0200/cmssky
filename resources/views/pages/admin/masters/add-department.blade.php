<x-app-layout title="Department" page="Add Department">
 
        <form action="{{route('admin.master.storeDepartment')}}">
            <div class="form-group">
                <div class="input-group">
                  <input type="text" class="form-control" oninput="noWhiteSpace(e)" id="department" placeholder="Department Name">
                  <div class="input-group-append">
                    <button class="btn btn-sm btn-primary" onclick="storeDepartment()" type="button">Add</button>
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
                    <tbody id="department">
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
</x-app-layout>

<script>

    function noWhiteSpace(e) {
      if(e.which === 32) 
      return false;
    }
    // $("#department").append(`
    //     <tr>
    //         <td>Jacob</td>
    //         <td>654</td>
    //     </tr>
    // `)

    $(document).ready(function () {
        function fetchDepartments() {
            $.ajax({
              type: "get",
              url: "{{route('admin.master.getDepartments')}}",
              dataType: "json",
              success: function (res) {
                console.log(res);
              }
            });
        }(fetchDepartments())

    });


    function storeDepartment() {
          let dept = $("#department").val()

          if(dept=="" || dept==null || dept==undefined ) {
            $("#error").text("Please enter Department")
          } else {
            $("#error").text("")
          }

          $.ajax({
            type: "post",
            url: "{{route('admin.master.storeDepartment')}}",
            data: {
              department: dept
            },
            dataType: "json",
            success: function (res) {
              alert('success')
            }
          });
        }

</script>