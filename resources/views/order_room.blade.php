@extends('layouts.app')

@section('head')
<style>
    header {
        height: auto !important;
    }
    #app {
        min-height: calc(100% - 50px - 320px);
    }
</style>
@endsection

@section('main-container')
<div class="row d-flex justify-content-center pt-5">
    <div class="col-10">
        <div class="col lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Your Cart</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-pending-tab" data-toggle="pill"
                                        href="#pills-pending" role="tab" aria-controls="pills-pending"
                                        aria-selected="true">Đang chờ thanh toán</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-compled-tab" data-toggle="pill" href="#pills-compled"
                                        role="tab" aria-controls="pills-compled" aria-selected="false">Hoàn thành</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-canceled-tab" data-toggle="pill"
                                        href="#pills-canceled" role="tab" aria-controls="pills-canceled"
                                        aria-selected="false">Đã hủy</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-pending" role="tabpanel"
                                    aria-labelledby="pills-pending-tab">
                                    @if ($roomsPending->isEmpty())
                                    <p>Không có phòng nào</p>
                                    @else
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width:10%;">Image</th>
                                                <th style="width:30%;">Room title</th>
                                                <th style="width:10%;">Tenants</th>
                                                <th style="width:10%;">Price</th>
                                                <th style="width:15%;">Arrival date</th>
                                                <th style="width:15%;">Departure date</th>
                                                <th style="width:10%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roomsPending as $room)
                                            <tr>
                                                <td>
                                                    <div class="box-image">
                                                        <img class="responsive"
                                                            src="{{ $room['images'][0]['file_name'] }}"
                                                            alt="image-room">
                                                    </div>
                                                </td>
                                                <td>{{ $room->title }}</td>
                                                <td>{{ $room->pivot->peoples }}</td>
                                                <td>{{ $room->price }}/vnd</td>
                                                <td>{{ $room->pivot->arrival_date }}</td>
                                                <td>{{ $room->pivot->departure_date }}</td>
                                                <td>
                                                    <button
                                                        type="button"
                                                        class="btn btn-warning button-cancel-booking"
                                                        data-room-id="{{ $room->id }}"
                                                    >Cancel</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="col-sm-12">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-4">
                                                {{ $roomsPending->links() }}
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="pills-compled" role="tabpanel"
                                    aria-labelledby="pills-compled-tab">
                                    @if ($roomsCompleted->isEmpty())
                                    <p>Không có phòng nào</p>
                                    @else
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width:15%;">Image</th>
                                                <th style="width:30%;">Room title</th>
                                                <th style="width:10%;">Tenants</th>
                                                <th style="width:10%;">Price</th>
                                                <th style="width:17.5%;">Arrival date</th>
                                                <th style="width:17.5%;">Departure date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roomsCompleted as $room)
                                            <tr>
                                                <td>
                                                    <div class="box-image">
                                                        <img class="responsive"
                                                            src="{{ $room['images'][0]['file_name'] }}"
                                                            alt="image-room">
                                                    </div>
                                                </td>
                                                <td>{{ $room->title }}</td>
                                                <td>{{ $room->pivot->peoples }}</td>
                                                <td>{{ $room->price }}/vnd</td>
                                                <td>{{ $room->pivot->arrival_date }}</td>
                                                <td>{{ $room->pivot->departure_date }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="col-sm-12">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-4">
                                                {{ $roomsCompleted->links() }}
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="pills-canceled" role="tabpanel"
                                    aria-labelledby="pills-canceled-tab">
                                    @if ($roomsCanceled->isEmpty())
                                    <p>Không có phòng nào</p>
                                    @else
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width:15%;">Image</th>
                                                <th style="width:30%;">Room title</th>
                                                <th style="width:10%;">Tenants</th>
                                                <th style="width:10%;">Price</th>
                                                <th style="width:17.5%;">Arrival date</th>
                                                <th style="width:17.5%;">Departure date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roomsCanceled as $room)
                                            <tr>
                                                <td>
                                                    <div class="box-image">
                                                        <img class="responsive"
                                                            src="{{ $room['images'][0]['file_name'] }}"
                                                            alt="image-room">
                                                    </div>
                                                </td>
                                                <td>{{ $room->title }}</td>
                                                <td>{{ $room->pivot->peoples }}</td>
                                                <td>{{ $room->price }}/vnd</td>
                                                <td>{{ $room->pivot->arrival_date }}</td>
                                                <td>{{ $room->pivot->departure_date }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="col-sm-12">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-4">
                                                {{ $roomsCanceled->links() }}
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('footer')
<script src="{{ asset('./js/booking.js') }}"></script>
@endsection
