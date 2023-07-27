@extends('admin.admin_dashboard')
@section('admin')

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

	<div class="page-content">

		<div class="row">
		</div>
		<div class="row profile-body">
			<!-- middle wrapper start -->
			<div class="col-md-8 col-xl-8 middle-wrapper">
				<div class="row">
					<div class="card">
						<div class="card-body">

							<h6 class="card-title">Store Amenity Name</h6>

							<form id= "myForm" method="post" action="{{route('store.amenity')}}" class="forms-sample">
								@csrf

								<div class="form-group mb-3">
									<label for="exampleInputUsername1" class="form-label">Amenity Name</label>
									<input type="text" class="form-control" name="amenity_name" >
								</div>

								<button type="submit" class="btn btn-primary me-2">Save Changes</button>
							</form>

						</div>
					</div>
				</div>
			</div>
			<!-- middle wrapper end -->
			<!-- right wrapper start -->
			<!-- right wrapper end -->
		</div>

	</div>

	<script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    amenity_name: {
                        required : true,
                    },

                },
                messages :{
                    amenity_name: {
                        required : 'Please Enter Amenity Name',
                    },


                },
                errorElement : 'span',
                errorPlacement: function (error,element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight : function(element, errorClass, validClass){
                    $(element).addClass('is-invalid');
                },
                unhighlight : function(element, errorClass, validClass){
                    $(element).removeClass('is-invalid');
                },
            });
        });

	</script>

@endsection