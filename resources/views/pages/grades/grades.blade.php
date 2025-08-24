@extends('layouts.master')
@section('css')
@section('title')
    {{ trans('main_trans.Grades') }}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ trans('main_trans.Grades') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">{{ trans('main_trans.Grades') }}</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            + {{ trans('grades_trans.Add_Grade') }}
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered p-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('grades_trans.Name') }}</th>
                                    <th>{{ trans('grades_trans.Notes') }}</th>
                                    <th>{{ trans('grades_trans.Proccess') }}</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($grades as $grade)
                                    <tr>
                                        <td>{{  $loop->iteration}}</td>
                                        <td>{{ $grade->Name }}</td>
                                        <td>{{ $grade->Notes }}</td>
                                        <td>
                                            <button type="submit" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $grade->id}}" title="{{ trans('grades_trans.Edit') }}"><i
                                                    class="fa fa-edit"></i></button>

                                            <button type="submit" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $grade->id}}"
                                                title="{{ trans('grades_trans.delete_Grade') }}"><i
                                                    class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>

                                    {{-- edit MODAL --}}
                                    <div class="modal fade" id="edit{{ $grade->id}}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        {{ trans('grades_trans.Add_Grade') }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <form action="{{ route('grade.update',$grade->id ) }}" method="POST">
                                                    @csrf
                                                    @method("PUT")
                                                    {{-- <input type="hidden" name="id" value="{{ }}"> --}}
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>{{ trans('grades_trans.Name') }} (AR)</label>
                                                            <input type="text" name="Name_ar" required class="form-control"
                                                            value="{{ $grade->getTranslation('Name', 'ar') }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>{{ trans('grades_trans.Name') }} (EN)</label>
                                                            <input type="text" name="Name_en" required class="form-control"
                                                            value="{{ $grade->getTranslation('Name', 'en') }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>{{ trans('grades_trans.Notes') }}</label>
                                                            <textarea class="form-control" name="Notes" rows="3"
                                                            >{{ $grade->Notes }}</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('grades_trans.Close') }}</button>
                                                        <button type="submit"
                                                            class="btn btn-success">{{ trans('grades_trans.submit') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="delete{{ $grade->id }}" tabindex="-1"
                                        aria-labelledby="deleteLabel{{ $grade->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteLabel{{ $grade->id }}">
                                                        {{ trans('grades_trans.delete_Grade') }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="{{ trans('Close') }}">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    {{ trans('grades_trans.warnning_Grade') }}:
                                                    <s>{{ $grade->Name }}</s>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('grades_trans.Cancel') }}</button>

                                                    <form action="{{ route('grade.destroy', $grade->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                    <input type="hidden" name="id" value="{{ $grade->id }}">
                                                        <button type="submit"
                                                            class="btn btn-danger">{{ trans('grades_trans.confirm_delete') }}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- Store MODAL --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ trans('grades_trans.Add_Grade') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('grade.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label>{{ trans('grades_trans.Name') }} (AR)</label>
                                <input type="text" name="Name_ar" required class="form-control">
                            </div>

                            <div class="form-group">
                                <label>{{ trans('grades_trans.Name') }} (EN)</label>
                                <input type="text" name="Name_en" required class="form-control">
                            </div>

                            <div class="form-group">
                                <label>{{ trans('grades_trans.Notes') }}</label>
                                <textarea class="form-control" name="Notes" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('grades_trans.Close') }}</button>
                            <button type="submit" class="btn btn-success">{{ trans('grades_trans.submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>





















    </div>
    <!-- row closed -->

@endsection
@section('js')

@endsection