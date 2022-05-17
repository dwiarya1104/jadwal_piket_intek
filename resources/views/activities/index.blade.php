@extends('layouts.master')

@section('main')
    <style>
        .activities {
            max-height: 1208px;
            position: relative;
        }

        .activities .unit {
            padding: 20px 0 20px 50px;
            min-height: 80px;
            position: relative;
            overflow: hidden;
        }

        .activities .unit .avatar {
            display: block;
            width: 40px;
            height: 40px;
            position: absolute;
            top: 20px;
            left: 0;
        }

        .activities .unit .avatar img {
            display: block;
            border-radius: 50%;
            max-width: 100%;
            margin-right: 10px;
        }

        .activities .unit .field {
            overflow: hidden;
            font-size: 14px;
            line-height: 20px;
        }

        .activities .unit .field a {
            font-weight: bold;
            color: #333333;
        }

        .activities .unit .field.btn-group-xs {
            padding: 20px 0 0;
        }

        .activities .unit .field {
            overflow: hidden;
            font-size: 14px;
            line-height: 20px;
        }

        .f-l {
            float: left;
        }

        .unit .avatar img {
            width: 50px !important;
            height: 50px !important;
        }

    </style>
    <div class="container-fluid">
        <div class="card shadow mb-5">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">ACTIVITIES</h6>
            </div>
            <div class="card-body">
                <div class="col-md-12 col-right">
                    <div class="col-inside-lg decor-default activities" id="activities">
                        @foreach ($data as $d)
                            <div class="unit">
                                {{-- ACTIVITY ADMIN --}}
                                @if ($d->name_admin)
                                    @if ($d->poto)
                                        <img class="rounded-circle avatar" width="50px"
                                            src="{{ asset('storage/pp' . $d->poto) }}" class="img-responsive"
                                            alt="profile">
                                    @else
                                        <img class="rounded-circle avatar" width="50px"
                                            src="{{ asset('assets/img/default.svg') }}" class="img-responsive"
                                            alt="profile">
                                    @endif

                                    <div class="card border-left-primary">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="field title">
                                                            <a>{{ $d->name_admin }}</a> . <span
                                                                class="f-r">{{ $d->created_at->diffForHumans() }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="field date">
                                                            Telah Menambahkan Tugas kepada <a
                                                                href="">{{ $d->name_user }}</a>
                                                            &nbsp;
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="field title">
                                        <a>{{ $d->name_admin }}</a> ∙ <span
                                            class="f-r">{{ $d->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="field date">
                                        Telas Menambahkan Tugas kepada <a href="">{{ $d->name_user }}</a> &nbsp;
                                    </div> --}}

                                    {{-- ACTIVITY USER --}}
                                @elseif($d->name_user)
                                    @if ($d->poto)
                                        <img class="rounded-circle avatar" width="50px"
                                            src="{{ asset('storage/pp' . $d->poto) }}" class="img-responsive"
                                            alt="profile">
                                    @else
                                        <img class="rounded-circle avatar" width="50px"
                                            src="{{ asset('assets/img/default.svg') }}" class="img-responsive"
                                            alt="profile">
                                    @endif
                                    <div class="card border-left-success">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="field title">
                                                            <a href="#">{{ $d->name_user }}</a> ∙ <span
                                                                class="f-r">{{ $d->created_at->diffForHumans() }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="field date">
                                                            Sudah menyelesaikan tugasnya
                                                        </div>
                                                        <div class="field photo">
                                                            <img src="{{ asset('storage/bukti/' . $d->gambar) }}"
                                                                alt="profile" width="400px;" style="max-width:200px;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="field title">
                                        <a href="#">{{ $d->name_user }}</a> ∙ <span
                                            class="f-r">{{ $d->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="field date">
                                        Sudah menyelesaikan tugasnya
                                    </div>
                                    <div class="field photo">
                                        <img src="{{ asset('storage/bukti/' . $d->gambar) }}" alt="profile" width="400px;"
                                            style="max-width:200px;">
                                    </div> --}}
                                @endif
                                {{-- @if ($d->poto)
                                    <img class="rounded-circle avatar" width="50px"
                                        src="{{ asset('storage/pp' . $d->poto) }}" class="img-responsive" alt="profile">
                                @else
                                    <img class="rounded-circle avatar" width="50px"
                                        src="{{ asset('assets/img/default.svg') }}" class="img-responsive" alt="profile">
                                @endif
                                <div class="field title">
                                    <a href="#">{{ $d->name_user }}</a> Sudah menyelesaikan tugasnya pada * <span
                                        class="f-r">{{ $d->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="field date">
                                    <span class="f-r">{{ $d->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="field photo">
                                    <img src="{{ asset('storage/bukti/' . $d->gambar) }}" alt="profile" width="400px;">
                                </div> --}}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
