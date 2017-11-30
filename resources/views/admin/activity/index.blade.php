@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Activity</div>

                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($activity as $item)
                                <li class="list-group-item justify-content-between">
                                    <a class="btn btn-link" data-toggle="collapse" href="#collapse{{ $item->id }}" aria-expanded="false" aria-controls="collapse{{ $item->id }}">
                                        {{ strtolower(preg_replace('/[\\\\]/', '_', $item->subject_type)).'.'.$item->description }}
                                    </a>
                                    <span class="pull-right"><small>{{ Carbon::parse($item->created_at)->diffForHumans() }}</small></span>
                                    <div class="collapse table-responsive" id="collapse{{ $item->id }}">
                                        <table class="table table-striped table-sm table-bordered">
                                            <tbody>
                                            <tr>
                                                <td>Log Name</td>
                                                <td>{{ $item->log_name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Description</td>
                                                <td>{{ $item->description }}</td>
                                            </tr>
                                            <tr>
                                                <td>Subject ID</td>
                                                <td>{{ $item->subject_id }}</td>
                                            </tr>
                                            <tr>
                                                <td>Subject Type</td>
                                                <td>{{ $item->subject_type }}</td>
                                            </tr>
                                            <tr>
                                                <td>Causer ID</td>
                                                <td>{{ $item->causer_id }}</td>
                                            </tr>
                                            <tr>
                                                <td>Causer Type</td>
                                                <td>{{ $item->causer_type }}</td>
                                            </tr>
                                            <tr>
                                                <td>Properties</td>
                                                <td>{{ $item->properties }}</td>
                                            </tr>
                                            <tr>
                                                <td>Created At</td>
                                                <td>{{ $item->created_at }}</td>
                                            </tr>
                                            <tr>
                                                <td>Updated At</td>
                                                <td>{{ $item->updated_at }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    {{ $activity->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection