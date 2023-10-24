@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-5 ">
        <div class="card overflow-hidden">
            <h5 class="card-header">Daftar Catatan</h5>
            <div class="card-datatable">
                <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer px-3 mb-3">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 px-3">
                            <div class="dataTables_length" id="DataTables_Table_3_length"><label><select
                                        name="DataTables_Table_3_length" aria-controls="DataTables_Table_3"
                                        class="form-select">
                                        <option value="7">7</option>
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="75">75</option>
                                        <option value="100">100</option>
                                    </select>Tampilkan Entri</label></div>
                        </div>
                        <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end px-3 pb-3">
                            <div id="DataTables_Table_3_filter" class="dataTables_filter"><label>Search<input type="search"
                                        class="form-control" placeholder="" aria-controls="DataTables_Table_3"></label>
                            </div>
                        </div>
                    </div>
                    <table class="dt-multilingual table dataTable no-footer dtr-column table-bordered" id="DataTables_Table_3"
                        aria-describedby="DataTables_Table_3_info" style="width: 1047px;">
                        <thead>
                            <tr>
                                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1"
                                    style="" aria-label="">No</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_3" rowspan="1"
                                    colspan="1" aria-label="Name: aktivieren, um Spalte aufsteigend zu sortieren">Judul
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_3" rowspan="1"
                                    colspan="1" aria-label="Position: aktivieren, um Spalte aufsteigend zu sortieren">
                                    Tanggal</th>
                                <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Actions">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Revisi 1</td>
                                <td>19-05-2006</td>
                                <td>
                                    <div class="d-inline-block"><a href="javascript:;"
                                            class="btn btn-sm btn-icon dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="text-primary ti ti-dots-vertical"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;"
                                                class="dropdown-item">Details</a><a href="javascript:;"
                                                class="dropdown-item">Archive</a>
                                            <div class="dropdown-divider"></div><a href="javascript:;"
                                                class="dropdown-item text-danger delete-record">Delete</a>
                                        </div>
                                    </div><a href="javascript:;" class="btn btn-sm btn-icon item-edit"><i
                                            class="text-primary ti ti-pencil"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Revisi 2</td>
                                <td>19-05-2006</td>
                                <td>
                                    <div class="d-inline-block"><a href="javascript:;"
                                            class="btn btn-sm btn-icon dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="text-primary ti ti-dots-vertical"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;"
                                                class="dropdown-item">Details</a><a href="javascript:;"
                                                class="dropdown-item">Archive</a>
                                            <div class="dropdown-divider"></div><a href="javascript:;"
                                                class="dropdown-item text-danger delete-record">Delete</a>
                                        </div>
                                    </div><a href="javascript:;" class="btn btn-sm btn-icon item-edit"><i
                                            class="text-primary ti ti-pencil"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Revisi 3</td>
                                <td>19-05-2006</td>
                                <td>
                                    <div class="d-inline-block"><a href="javascript:;"
                                            class="btn btn-sm btn-icon dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="text-primary ti ti-dots-vertical"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;"
                                                class="dropdown-item">Details</a><a href="javascript:;"
                                                class="dropdown-item">Archive</a>
                                            <div class="dropdown-divider"></div><a href="javascript:;"
                                                class="dropdown-item text-danger delete-record">Delete</a>
                                        </div>
                                    </div><a href="javascript:;" class="btn btn-sm btn-icon item-edit"><i
                                            class="text-primary ti ti-pencil"></i></a>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_info" id="DataTables_Table_3_info" role="status" aria-live="polite">
                                1 hingga 7 dari 100 entri</div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_3_paginate">
                                <ul class="pagination">
                                    <li class="paginate_button page-item previous disabled"
                                        id="DataTables_Table_3_previous">
                                        <a aria-controls="DataTables_Table_3" aria-disabled="true" role="link"
                                            data-dt-idx="previous" tabindex="0" class="page-link">Kembali</a>
                                    </li>
                                    <li class="paginate_button page-item active"><a href="#"
                                            aria-controls="DataTables_Table_3" role="link" aria-current="page"
                                            data-dt-idx="0" tabindex="0" class="page-link">1</a></li>
                                    <li class="paginate_button page-item "><a href="#"
                                            aria-controls="DataTables_Table_3" role="link" data-dt-idx="1" tabindex="0"
                                            class="page-link">2</a></li>
                                    <li class="paginate_button page-item "><a href="#"
                                            aria-controls="DataTables_Table_3" role="link" data-dt-idx="2"
                                            tabindex="0" class="page-link">3</a></li>
                                    <li class="paginate_button page-item "><a href="#"
                                            aria-controls="DataTables_Table_3" role="link" data-dt-idx="3"
                                            tabindex="0" class="page-link">4</a></li>
                                    <li class="paginate_button page-item "><a href="#"
                                            aria-controls="DataTables_Table_3" role="link" data-dt-idx="4"
                                            tabindex="0" class="page-link">5</a></li>
                                    <li class="paginate_button page-item disabled" id="DataTables_Table_3_ellipsis"><a
                                            aria-controls="DataTables_Table_3" aria-disabled="true" role="link"
                                            data-dt-idx="ellipsis" tabindex="0" class="page-link">…</a></li>
                                    <li class="paginate_button page-item "><a href="#"
                                            aria-controls="DataTables_Table_3" role="link" data-dt-idx="14"
                                            tabindex="0" class="page-link">15</a></li>
                                    <li class="paginate_button page-item next" id="DataTables_Table_3_next"><a
                                            href="#" aria-controls="DataTables_Table_3" role="link"
                                            data-dt-idx="next" tabindex="0" class="page-link">Berikutnya</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
