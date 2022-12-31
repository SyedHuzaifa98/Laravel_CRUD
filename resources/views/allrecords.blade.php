<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="jquery-3.6.2.js"></script>
    <link rel="shortcut icon" href="img/emp.png" type="image/x-icon">
    <title>All Employees</title>
</head>

<body>


    <div id="search">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <a class="btn btn-primary" data-toggle="modal" data-target="#create"><i class="fa-solid fa-plus"></i> Create</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Delete</th>
                <th scope="col">Update</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($get as $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->username }}</td>
                    <td>{{ $value->email }}</td>
                    <td>{{ $value->phone }}</td>
                    <td> <a href="{{ url('/datadelete',$value->id) }}" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Delete</a> </td>
                    <td> <a href="" class="btn btn-success" onclick="updatedata({{ $value->id }})"
                            data-toggle="modal" data-target="#update">
                            <i class="fa-regular fa-pen-to-square"></i> Update
                        </a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>





    <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create new record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('/dataupload') }}">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Username</label>
                            <input type="text" class="form-control" name="username">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Email</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Phone</label>
                            <input type="number" class="form-control" name="phone">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>







    <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                        <form method="POST" action="{{ url('/dataupdatesubmit') }}" id="up_form">
                            @csrf
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Username</label>
                                <input type="text" class="form-control" id="up_username" value="" name="username">
                                <input type="text" hidden id="olduser" name="olduser">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Email</label>
                                <input type="email" class="form-control" id="up_email" value="" name="email">
                                <input type="email" hidden id="oldemail" name="oldemail">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Phone</label>
                                <input type="number" class="form-control" id="up_phone" value="" name="phone">
                                <input type="number" hidden id="oldphone" name="oldphone">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>

                        </form>

                </div>

            </div>
        </div>
    </div>
</body>

</html>

<script>
    function updatedata(id1) {
        $.ajax({
            url: 'dataupdate/{id}',
            type: 'GET',
            data:{id:id1},
            success: function(data) {
                $('#up_username').val(data.username);
                $('#olduser').val(data.username);

                $('#up_email').val(data.email);
                $('#oldemail').val(data.email);

                $('#up_phone').val(data.phone);
                $('#oldphone').val(data.phone);


            }
        });
    }

    $('#search').find('input').on('keyup',function (){
        var value=$(this).val();
        $.ajax({
            url: 'search',
            type:'GET',
            data:{'search':value},
            success:function (data) {
                $('tbody').html(data);
            }
        });
    })
</script>
<script src="jquery-3.6.2.js"></script>
