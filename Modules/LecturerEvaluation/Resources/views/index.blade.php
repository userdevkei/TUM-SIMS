@extends('lecturerevaluation::layouts.backend')

@section('content')
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Lecturer evaluation <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Rate your lecture per unit.</small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Tables</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">DataTables</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


    <!-- Page Content -->
    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block block-rounded">
            <div class="block-header">
                <h3 class="block-title">Dynamic Table <small>Full</small></h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <table class="table table-sm table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">ID</th>
                        <th>Unit Code</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Unit Name</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Unit Lecturer</th>
                        <th style="width: 15%;">Status</th>
                        <th style="width: 15%;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-center font-size-sm">1</td>
                        <td class="font-w600 font-size-sm">
                            <a href="#">CIT 2101</a>
                        </td>
                        <td class="d-none d-sm-table-cell font-size-sm">
                            <em class="text-muted">Computer Applications 1</em>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            Mr. Kitili
                        </td>
                        <td>
                            <span class="badge badge-danger">Not rated</span>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            <button type="button" class="btn btn-sm btn-alt-info" data-toggle="modal" data-target="#modal-block-fromright"> evaluate </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center font-size-sm">2</td>
                        <td class="font-w600 font-size-sm">
                            <a href="#">CIT 2101</a>
                        </td>
                        <td class="d-none d-sm-table-cell font-size-sm">
                            <em class="text-muted">Computer Applications 1</em>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            Mr. Kitili
                        </td>
                        <td>
                            <span class="badge badge-danger">Not rated</span>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-alt-info" data-toggle="modal" data-target="#modal-block-fromright"> evaluate </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center font-size-sm">3</td>
                        <td class="font-w600 font-size-sm">
                            <a href="#">CIT 2101</a>
                        </td>
                        <td class="d-none d-sm-table-cell font-size-sm">
                            <em class="text-muted">Computer Applications 1</em>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            Mr. Kitili
                        </td>
                        <td>
                            <span class="badge badge-danger">Not rated</span>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-alt-info" data-toggle="modal" data-target="#modal-block-fromright"> evaluate </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center font-size-sm">4</td>
                        <td class="font-w600 font-size-sm">
                            <a href="#">CIT 2101</a>
                        </td>
                        <td class="d-none d-sm-table-cell font-size-sm">
                            <em class="text-muted">Computer Applications 1</em>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            Mr. Kitili
                        </td>
                        <td>
                            <span class="badge badge-danger">Not rated</span>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-alt-info" data-toggle="modal" data-target="#modal-block-fromright"> evaluate </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center font-size-sm">5</td>
                        <td class="font-w600 font-size-sm">
                            <a href="#">CIT 2101</a>
                        </td>
                        <td class="d-none d-sm-table-cell font-size-sm">
                            <em class="text-muted">Computer Applications 1</em>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            Mr. Kitili
                        </td>
                        <td>
                            <span class="badge badge-danger">Not rated</span>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-alt-info" data-toggle="modal" data-target="#modal-block-fromright"> evaluate </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center font-size-sm">6</td>
                        <td class="font-w600 font-size-sm">
                            <a href="#">CIT 2101</a>
                        </td>
                        <td class="d-none d-sm-table-cell font-size-sm">
                            <em class="text-muted">Computer Applications 1</em>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            Mr. Kitili
                        </td>
                        <td>
                            <span class="badge badge-danger">Not rated</span>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-alt-info" data-toggle="modal" data-target="#modal-block-fromright"> evaluate </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center font-size-sm">7</td>
                        <td class="font-w600 font-size-sm">
                            <a href="#">CIT 2101</a>
                        </td>
                        <td class="d-none d-sm-table-cell font-size-sm">
                            <em class="text-muted">Computer Applications 1</em>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            Mr. Kitili
                        </td>
                        <td>
                            <span class="badge badge-success">Not rated</span>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-alt-info" data-toggle="modal" data-target="#modal-block-fromright"> evaluate </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="modal fade" id="modal-block-fromright" tabindex="-1" role="dialog" aria-labelledby="modal-block-fromright" aria-hidden="true">
            <div class="modal-dialog modal-dialog-fromright" role="document">
                <div class="modal-content">
                    <div class="block block-rounded block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Modal Title</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content font-size-sm">
                            <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                            <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                        </div>
                        <div class="block-content block-content-full text-right border-top">
                            <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
