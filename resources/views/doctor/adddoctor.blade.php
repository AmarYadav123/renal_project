@extends('admin.master');
@section('title','Doctor List')
@section('content')
<!-- Table Starts -->
{{-- cardstart --}}

<div class="card">
    <div class="card-header">
        @if(session('message'))

        <p class ="alert alert-success">
         {{session('message')}}
        </p>

        @endif
        <a href="" class="btn btn-info" style="float: right;" data-toggle="modal" data-target="#zz">Add Doctor</a>
        <h3 class="card-title">Doctor List</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body w-100">
      <table id="example2" class="table table-bordered table-hover w-100">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($doctor as $a)

            <tr>
                <td>{{$a->name}}</td>
                <td>{{$a->email}}</td>
                <td>{{$a->phone}}</td>
            </tr>

            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

{{-- cardend --}}

<!-- Table Ends -->
<section>
<!-- Button trigger modal -->
<div class="modal fade" id="zz">
<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-content">

  </div>
  <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Catagory</h5>
         <button type="button" class="close" data-dismiss="modal">
            <span >&times;</span>
         </button>
  </div>
<!-- Button trigger modal -->
  <div class="modal-body">
      <form method="post" action="{{url('doctor_insert')}}" enctype="multipart/form-data">
        @csrf
            <input type="hidden" name="role" value="1">
            <div class="form-group">
               <label>Name</label>
               <input type="text" name="name" class="form-control" required>
            </div>

            <div class="form-group">
               <label>Email</label>
               <textarea name="email" class="form-control" required></textarea>
            </div>

            <div class="form-group">
               <label>Phone</label>
               <input type="text" name="phone" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="text" name="password" class="form-control" required>
             </div>


              <button class="btn btn-info btn-block" value="submit">Submit</button>

        </form>
  </div>
</div>
</div><!----- model fade div end-------->
</section>
@endsection
