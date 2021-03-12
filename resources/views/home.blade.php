@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" id="card-header"><span>{{ __('Dashboard') }}</span></div>
                    <div class="m-3">
                        <a href="{{ route('create') }}" class="float-right btn btn-primary">Add New Vehicle</a>
                    </div>
                    <div class="card-body">

                        <table class="table mt-2">
                            <thead>
                                <tr>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>Plate Number</th>
                                    <th>Insurance Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            let headers = {
                "Accept": 'application/json',
                'Authorization': 'Bearer {{ Auth::user()->api_token }}'
            }

            $.ajax({
                url: '/api/vehicles',
                headers: headers,
                method: 'GET',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                }
            }).done(function(data) {
                data.vehicles.forEach(vehicle => {
                    let url = "{{ route('edit', 'id') }}";
                    url = url.replace('id', vehicle.id);
                    $('.table-body').append(
                        ` <tr id="tableRow${vehicle.id}">
                                    <td>${vehicle.brand}</td>
                                    <td>${vehicle.model}</td>
                                    <td>${vehicle.plate_number}</td>
                                    <td>${vehicle.insurance_date}</td>                                                                                          <td>
                                        <a href="${url}" class="btn btn-info btn-sm">Edit</a>
                                        <button data-id="${vehicle.id}" class="btn btn-danger btn-sm deleteVehicleBtn">Delete</button>
                                    </td>
                                </tr>
                                `)
                });
            });


            $(document).on('click', '.deleteVehicleBtn', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                let tableRow = 'tableRow-' + id;
                let headers = {
                    "Accept": 'application/json',
                    'Authorization': 'Bearer {{ Auth::user()->api_token }}'
                }

                $.ajax({
                    url: '/api/vehicles/delete',
                    method: 'DELETE',
                    headers: headers,
                    data: {
                        id: id,
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    }
                }).done(function(data) {
                    document.getElementById(tableRow).remove();
                    return 'success';
                });
            });


        });

    </script>
@endsection
