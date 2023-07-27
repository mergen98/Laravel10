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

							<h6 class="card-title">Edit Amenity</h6>

							<form method="post" action="{{route('update.amenity')}}" class="forms-sample">
								@csrf
								<input type="hidden" class="form-control" name="id" value="{{$amenity->id}}">

								<div class="mb-3">
									<label for="exampleInputUsername1" class="form-label">Amenity Name</label>
									<input type="text" class="form-control @error('amenity_name') is-invalid @enderror" name="amenity_name" value="{{$amenity->amenity_name}}">
									@error('amenity_name')
									<span class="text-danger">{{$message}}</span>
									@enderror
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

@endsection