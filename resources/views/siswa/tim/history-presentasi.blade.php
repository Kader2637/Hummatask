@extends('layouts.tim')

@section('content')



    <div class="container mt-3">
        <div class="card">
            <h5 class="card-header">History Presentasi</h5>

            <div class="row px-3">
                <div class="col-sm-12 col-md-6">
                    <div class="dataTables_length" id="DataTables_Table_0_length"><label
                            class="d-flex align-items-center gap-2 mb-3">Show <select name="DataTables_Table_0_length"
                                aria-controls="DataTables_Table_0" class="form-select w-25">
                                <option value="7">7</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="75">75</option>
                                <option value="100">100</option>
                            </select> entries</label></div>
                </div>

            </div>

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="bg-primary">
                        <tr>
                            <th class="text-white">Presentasi</th>
                            <th class="text-white">Tanggal</th>
                            <th class="text-white">Status</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td><span class="fw-medium">Progres Figma</span></td>
                            <td>12 Oktober 2023</td>
                            <td><span class="badge bg-label-success me-1">Sukses</span></td>
                        </tr>
                        <tr>
                            <td><span class="fw-medium">Progres Figma</span></td>
                            <td>12 Oktober 2023</td>
                            <td><span class="badge bg-label-success me-1">Sukses</span></td>
                        </tr>
                        <tr>
                            <td><span class="fw-medium">Progres Figma</span></td>
                            <td>12 Oktober 2023</td>
                            <td><span class="badge bg-label-success me-1">Sukses</span></td>
                        </tr>
                        <tr>
                            <td><span class="fw-medium">Progres Figma</span></td>
                            <td>12 Oktober 2023</td>
                            <td><span class="badge bg-label-success me-1">Sukses</span></td>
                        </tr>
                        <tr>
                            <td><span class="fw-medium">Progres Figma</span></td>
                            <td>12 Oktober 2023</td>
                            <td><span class="badge bg-label-success me-1">Sukses</span></td>
                        </tr>
                        <tr>
                            <td><span class="fw-medium">Progres Figma</span></td>
                            <td>12 Oktober 2023</td>
                            <td><span class="badge bg-label-success me-1">Sukses</span></td>
                        </tr>

                    </tbody>
                </table>
                <div class="container mt-3">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_info" id="DataTables_Table_1_info" role="status" aria-live="polite">Showing
                                1 to 7 of 100 entries</div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_1_paginate">
                                <ul class="pagination">
                                    <li class="paginate_button page-item previous disabled" id="DataTables_Table_1_previous"><a
                                            aria-controls="DataTables_Table_1" aria-disabled="true" role="link"
                                            data-dt-idx="previous" tabindex="0" class="page-link">Previous</a></li>
                                    <li class="paginate_button page-item active"><a href="#"
                                            aria-controls="DataTables_Table_1" role="link" aria-current="page"
                                            data-dt-idx="0" tabindex="0" class="page-link">1</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_1"
                                            role="link" data-dt-idx="1" tabindex="0" class="page-link">2</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_1"
                                            role="link" data-dt-idx="2" tabindex="0" class="page-link">3</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_1"
                                            role="link" data-dt-idx="3" tabindex="0" class="page-link">4</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_1"
                                            role="link" data-dt-idx="4" tabindex="0" class="page-link">5</a></li>
                                    <li class="paginate_button page-item disabled" id="DataTables_Table_1_ellipsis"><a
                                            aria-controls="DataTables_Table_1" aria-disabled="true" role="link"
                                            data-dt-idx="ellipsis" tabindex="0" class="page-link">…</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_1"
                                            role="link" data-dt-idx="14" tabindex="0" class="page-link">15</a></li>
                                    <li class="paginate_button page-item next" id="DataTables_Table_1_next"><a href="#"
                                            aria-controls="DataTables_Table_1" role="link" data-dt-idx="next"
                                            tabindex="0" class="page-link">Next</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
