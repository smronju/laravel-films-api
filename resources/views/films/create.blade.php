@extends ('layouts.app')

@section ('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('save.films') }}" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="InputTitle">Name <span class="text-danger">*</span></label>
                                <input type="text" required name="name" class="form-control" id="name" placeholder="Film name">
                            </div>
                            <div class="form-group">
                                <label for="description">Description <span class="text-danger">*</span></label>
                                <textarea name="description" required class="form-control" id="description" placeholder="Film description"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="release_date">Release date <span class="text-danger">*</span></label>
                                <input type="date" required name="release_date" class="form-control" id="release_date" placeholder="Release date">
                            </div>

                            <div class="form-group">
                                <label for="rating">Rating <span class="text-danger">*</span></label>
                                <input type="range" required min="1" max="5" name="rating" class="form-control" id="rating" placeholder="Rating">
                            </div>

                            <div class="form-group">
                                <label for="ticket_price">Ticket price <span class="text-danger">*</span></label>
                                <input type="number" name="ticket_price" class="form-control" id="ticket_price" placeholder="Ticket price">
                            </div>

                            <div class="form-group">
                                <label for="country">Country <span class="text-danger">*</span></label>
                                <input type="text" required name="country" class="form-control" id="country" placeholder="Country">
                            </div>

                            <div class="form-group">
                                <label for="genre">Genre <span class="text-danger">*</span></label>
                                <input type="text" required name="genre" class="form-control" id="genre" placeholder="Genre">
                            </div>

                            <div class="form-group">
                                <label for="InputContent">Poster <span class="text-danger">*</span></label>
                                <input type="file" required name="photo" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
