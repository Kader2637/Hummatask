@extends('layoutsMentor.app')

@section('content')
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3">
      <span class="text-muted fw-light"></span> History
    </h4>
    <div class="d-flex card flex-md-row align-items-center justify-content-between">
      <div class=" nav nav-pills mb-3 mt-3 d-flex flex-wrap navbar-ul px-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
            type="button" role="tab" aria-controls="pills-home" aria-selected="true" data-tab="1"><i
              class="fa-solid fa-calendar-xmark icon-text me-2"></i>Telat Presentasi</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
            type="button" role="tab" aria-controls="pills-profile" aria-selected="false" data-tab="2"><i
              class="fa-solid fa-person-chalkboard icon-text me-2"></i>Selesai Presentasi</button>
        </li>
      </div>
    </div>
    <div class="tab-content px-0 mt-2" id="pills-tabContent">
      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
        tabindex="0">
        <div class="card">
          <div class="card-datatable table-responsive">
            <table id="jstabel1" class="dt-responsive table">
              <thead>
                <tr>
                  <th scope="col">NO</th>
                  <th scope="col">TEAM</th>
                  <th scope="col">DEADLINE</th>
                  <th scope="col">PROJECT</th>
                  <th scope="col">TEMA</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Bababoi</td>
                  <td>15/90/2400</td>
                  <td><span class="badge bg-label-primary me-1">Big Project</span></td>
                  <td>E-Commers</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
        <div class="card">
          <div class="card-datatable table-responsive">
            <table id="jstabel2" class="dt-responsive table">
              <thead>
                <tr>
                  <th scope="col">NO</th>
                  <th scope="col">TEAM</th>
                  <th scope="col">TANGGAl</th>
                  <th scope="col">PROJECT</th>
                  <th scope="col">TEMA</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Bababoi</td>
                  <td>15/90/2400</td>
                  <td><span class="badge bg-label-primary me-1">Big Project</span></td>
                  <td>E-Commers</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
