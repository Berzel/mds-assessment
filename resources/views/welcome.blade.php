@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <div class="d-flex justify-content-between" style="align-items: center;">
        <div>
            <h1 class="mb-0">
                Tasks
            </h1>
        </div>
        <div>
            <button class="btn btn-primary btn-small" type="button">
                New Task
            </button>
        </div>
    </div> --}}

    {{-- <form class="d-flex mt-2" role="search">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
            <select class="form-select" id="inputGroupSelect01">
                <option selected>Status...</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
            <button class="btn btn-secondary" type="button" id="button-addon2">
                Filter
            </button>
        </div>
    </form> --}}

    <div class="mt-2">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h5 mb-0">
                    Tasks
                </h2>
                <small class="">
                    Showing 1 - 15 of 100 tasks
                </small>
            </div>
            <div>
                <a href="#" class="btn btn-primary">
                    Add Task
                </a>
            </div>
        </div>

        <table class="table table-hover bg-white rounded shadow-sm mt-2 overflow-hidden">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>Jawi</td>
                <td>@twitter</td>
              </tr>
            </tbody>
        </table>
    </div>

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
    </nav>
</div>
@endsection
