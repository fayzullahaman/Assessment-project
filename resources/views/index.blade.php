<!DOCTYPE html>
<html lang="en">

<head>
    <title>eTracker Solution</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-2 "></div>
            <div class="col-8 ">
                @if (isset($developer))
                    <form action="{{ route('developers.update', $developer->id) }}" method="post" enctype="multipart/form-data">
                        @method('put')
                    @else
                        <form action="{{ route('developers.store') }}" method="post" enctype="multipart/form-data">
                @endif
                @csrf
                <div class="row mb-3">
                    <label for="inputName" class="col-sm-2 col-form-label">Name:</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            placeholder="Name"
                            value="{{ isset($developer) ? old('name', $developer->name) : old('name') }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            placeholder="Email"
                            value="{{ isset($developer) ? old('email', $developer->email) : old('email') }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="image" class="col-sm-2 col-form-label">Image:</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="gender" class="col-sm-2 col-form-label">Gender:</label>
                    <div class="col-sm-10">
                        <input type="radio" class="@error('gender') is-invalid @enderror" name="gender"
                            value="0"
                            {{ isset($developer) ? (old('gender', $developer->gender) == 0 ? 'checked' : '') : (old('gender') == 0 ? 'checked' : '') }}>
                        Male
                        <input type="radio" class="@error('gender') is-invalid @enderror" name="gender"
                            value="1"
                            {{ isset($developer) ? (old('gender', $developer->gender) == 1 ? 'checked' : '') : (old('gender') == 1 ? 'checked' : '') }}>
                        Female
                        @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="gender" class="col-sm-2 col-form-label">Gender:</label>
                    <div class="col-sm-10">
                        <input type="checkbox" name="skills[]" value="laravel"
                            @if (isset($developer) && in_array('laravel', $developer->skills)) {{ 'checked' }} @endif> Laravel
                        <input type="checkbox" name="skills[]" value="codeigniter"> Codeigniter
                    </div>
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <input type="checkbox" name="skills[]" value="ajax"> Ajax
                        <input type="checkbox" name="skills[]" value="vuejs"> VUE JS
                    </div>
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10 mt-3">
                        <input type="checkbox" name="skills[]" value="mysql"> MySQL
                        <input type="checkbox" name="skills[]" value="api"> API
                    </div>
                    @error('skills')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10 offset-sm-2 d-flex justify-content-center">
                    <input type="submit"
                      value="@isset($developer) UPDATE @else SUBMIT @endisset"
                      class="btn btn-primary">
                </div>
            </div>
            </form>
        </div>
        <div class="col-2 "></div>

        <hr>
        <div class="row">
            <h1 style="text-align: center">List of Data</h1>
            <table style="text-align: center" class="table-bordered mt-5">
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Image</th>
                    <th>Gender</th>
                    <th>Skills</th>
                    <th>Action</th>
                </tr>
                @foreach ($developers as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td><img src="/uploads/{{ $item->image }}" width="80px"></td>
                        <td>
                            @if ($item->gender == 0)
                                Male
                            @else
                                Female
                            @endif
                        </td>
                        <td>{{ implode(', ', $item->skills) }} </td>
                        <td class="d-flex justify-content-center">
                            <a class="btn btn-primary" href="{{ route('developers.edit', $item->id) }}">Edit</a>
                            <form action="{{ route('developers.destroy', $item->id) }}" method="POST">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger mx-2">Delete</button>

                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

</body>

</html>
