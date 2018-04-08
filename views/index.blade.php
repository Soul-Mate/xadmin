@extends('admin::layouts.index')
@section('content')
    <section class="content-header">
        <h1>
            Dashboard
            <small>Description...</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">User login</h3>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <div class="box-body" style="display: block;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>用户名</td>
                                    <td>邮箱</td>
                                    <td>ip地址</td>
                                    <td>区域</td>
                                    <td>登陆次数</td>
                                    <td>登陆时间</td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($loginLogs as $loginLog)
                                    <tr>
                                        <td>{{$loginLog->name}}</td>
                                        <td>{{$loginLog->email}}</td>
                                        <td>
                                            <span class="label label-success">
                                                {{$loginLog->ip}}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="label label-success">
                                                {{$loginLog->country.' '.$loginLog->province.' '.$loginLog->city}}
                                            </span>
                                        </td>
                                        <td>
                                                {{$loginLog->times}}
                                        </td>
                                        <td>{{$loginLog->time}}</td>
                                    </tr>
                                    @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
