@extends('layouts.tim')


@section('link')


<!-- Vendor Styles -->
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/jkanban/jkanban.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}" />


<!-- Page Styles -->
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-kanban.css') }}" />

  <!-- Include Scripts for customizer, helper, analytics, config -->
  <!-- $isFront is used to append the front layout scriptsIncludes only on the front layout otherwise the variable will be blank -->
  <!-- laravel style -->
<script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
<!-- beautify ignore:start -->
  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
  {{-- <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script> --}}

  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  {{-- <script src="{{ asset('assets/js/config.js') }}"></script> --}}

@endsection

@section('content')
<div class="content-wrapper">

    <!-- Content -->
              <div class="container-xxl flex-grow-1 container-p-y">

        <div class="app-kanban">

<!-- Add new board -->
<div class="row">
<div class="col-12">
  <form class="kanban-add-new-board">
    <label class="kanban-add-board-btn" for="kanban-add-board-input">
      <i class="ti ti-plus ti-xs"></i>
      <span class="align-middle">Add new</span>
    </label>
    <input type="text" class="form-control w-px-250 kanban-add-board-input mb-2 d-none" placeholder="Add Board Title" id="kanban-add-board-input" required />
    <div class="mb-3 kanban-add-board-input d-none">
      <button class="btn btn-primary btn-sm me-2">Add</button>
      <button type="button" class="btn btn-label-secondary btn-sm kanban-add-board-cancel-btn">Cancel</button>
    </div>
  </form>
</div>
</div>

<!-- Kanban Wrapper -->
<div class="kanban-wrapper"></div>

<!-- Edit Task & Activities -->
<div class="offcanvas offcanvas-end kanban-update-item-sidebar">
<div class="offcanvas-header border-bottom">
  <h5 class="offcanvas-title">Edit Task</h5>
  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body">
  <ul class="nav nav-tabs tabs-line">
    <li class="nav-item">
      <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-update">
        <i class="ti ti-edit me-2"></i>
        <span class="align-middle">Edit</span>
      </button>
    </li>
    <li class="nav-item">
      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-activity">
        <i class="ti ti-trending-up me-2"></i>
        <span class="align-middle">Activity</span>
      </button>
    </li>
  </ul>
  <div class="tab-content px-0 pb-0">
    <!-- Update item/tasks -->
    <div class="tab-pane fade show active" id="tab-update" role="tabpanel">
      <form>
        <div class="mb-3">
          <label class="form-label" for="title">Title</label>
          <input type="text" id="title" class="form-control" placeholder="Enter Title" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="due-date">Due Date</label>
          <input type="text" id="due-date" class="form-control" placeholder="Enter Due Date" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="label"> Label</label>
          <select class="select2 select2-label form-select" id="label">
            <option data-color="bg-label-success" value="UX">UX</option>
            <option data-color="bg-label-warning" value="Images">
              Images
            </option>
            <option data-color="bg-label-info" value="Info">Info</option>
            <option data-color="bg-label-danger" value="Code Review">
              Code Review
            </option>
            <option data-color="bg-label-secondary" value="App">
              App
            </option>
            <option data-color="bg-label-primary" value="Charts & Maps">
              Charts & Maps
            </option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Assigned</label>
          <div class="assigned d-flex flex-wrap"></div>
        </div>
        <div class="mb-3">
          <label class="form-label" for="attachments">Attachments</label>
          <input type="file" class="form-control" id="attachments" />
        </div>
        <div class="mb-4">
          <label class="form-label">Comment</label>
          <div class="comment-editor border-bottom-0"></div>
          <div class="d-flex justify-content-end">
            <div class="comment-toolbar">
              <span class="ql-formats me-0">
                <button class="ql-bold"></button>
                <button class="ql-italic"></button>
                <button class="ql-underline"></button>
                <button class="ql-link"></button>
                <button class="ql-image"></button>
              </span>
            </div>
          </div>
        </div>
        <div class="d-flex flex-wrap">
          <button type="button" class="btn btn-primary me-3" data-bs-dismiss="offcanvas">
            Update
          </button>
          <button type="button" class="btn btn-label-danger" data-bs-dismiss="offcanvas">
            Delete
          </button>
        </div>
      </form>
    </div>
    <!-- Activities -->
    <div class="tab-pane fade" id="tab-activity" role="tabpanel">
      <div class="media mb-4 d-flex align-items-start">
        <div class="avatar me-2 flex-shrink-0 mt-1">
          <span class="avatar-initial bg-label-success rounded-circle">HJ</span>
        </div>
        <div class="media-body">
          <p class="mb-0">
            <span class="fw-medium">Jordan</span> Left the board.
          </p>
          <small class="text-muted">Today 11:00 AM</small>
        </div>
      </div>
      <div class="media mb-4 d-flex align-items-start">
        <div class="avatar me-2 flex-shrink-0 mt-1">
          <img src="../../demo/assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
        </div>
        <div class="media-body">
          <p class="mb-0">
            <span class="fw-medium">Dianna</span> mentioned
            <span class="text-primary">@bruce</span> in
            a comment.
          </p>
          <small class="text-muted">Today 10:20 AM</small>
        </div>
      </div>
      <div class="media mb-4 d-flex align-items-start">
        <div class="avatar me-2 flex-shrink-0 mt-1">
          <img src="../../demo/assets/img/avatars/2.png" alt="Avatar" class="rounded-circle" />
        </div>
        <div class="media-body">
          <p class="mb-0">
            <span class="fw-medium">Martian</span> added moved
            Charts & Maps task to the done board.
          </p>
          <small class="text-muted">Today 10:00 AM</small>
        </div>
      </div>
      <div class="media mb-4 d-flex align-items-start">
        <div class="avatar me-2 flex-shrink-0 mt-1">
          <img src="../../demo/assets/img/avatars/1.png" alt="Avatar" class="rounded-circle" />
        </div>
        <div class="media-body">
          <p class="mb-0">
            <span class="fw-medium">Barry</span> Commented on App
            review task.
          </p>
          <small class="text-muted">Today 8:32 AM</small>
        </div>
      </div>
      <div class="media mb-4 d-flex align-items-start">
        <div class="avatar me-2 flex-shrink-0 mt-1">
          <span class="avatar-initial bg-label-secondary rounded-circle">BW</span>
        </div>
        <div class="media-body">
          <p class="mb-0">
            <span class="fw-medium">Bruce</span> was assigned
            task of code review.
          </p>
          <small class="text-muted">Today 8:30 PM</small>
        </div>
      </div>
      <div class="media mb-4 d-flex align-items-start">
        <div class="avatar me-2 flex-shrink-0 mt-1">
          <span class="avatar-initial bg-label-danger rounded-circle">CK</span>
        </div>
        <div class="media-body">
          <p class="mb-0">
            <span class="fw-medium">Clark</span> assigned task UX
            Research to
            <span class="text-primary">@martian</span>
          </p>
          <small class="text-muted">Today 8:00 AM</small>
        </div>
      </div>
      <div class="media mb-4 d-flex align-items-start">
        <div class="avatar me-2 flex-shrink-0 mt-1">
          <img src="../../demo/assets/img/avatars/4.png" alt="Avatar" class="rounded-circle" />
        </div>
        <div class="media-body">
          <p class="mb-0">
            <span class="fw-medium">Ray</span> Added moved
            <span class="fw-medium">Forms & Tables</span> task
            from in progress to done.
          </p>
          <small class="text-muted">Today 7:45 AM</small>
        </div>
      </div>
      <div class="media mb-4 d-flex align-items-start">
        <div class="avatar me-2 flex-shrink-0 mt-1">
          <img src="../../demo/assets/img/avatars/1.png" alt="Avatar" class="rounded-circle" />
        </div>
        <div class="media-body">
          <p class="mb-0">
            <span class="fw-medium">Barry</span> Complete all the
            tasks assigned to him.
          </p>
          <small class="text-muted">Today 7:17 AM</small>
        </div>
      </div>
      <div class="media mb-4 d-flex align-items-start">
        <div class="avatar me-2 flex-shrink-0 mt-1">
          <span class="avatar-initial bg-label-success rounded-circle">HJ</span>
        </div>
        <div class="media-body">
          <p class="mb-0">
            <span class="fw-medium">Jordan</span> added task to
            update new images.
          </p>
          <small class="text-muted">Today 7:00 AM</small>
        </div>
      </div>
      <div class="media mb-4 d-flex align-items-start">
        <div class="avatar me-2 flex-shrink-0 mt-1">
          <img src="../../demo/assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
        </div>
        <div class="media-body">
          <p class="mb-0">
            <span class="fw-medium">Dianna</span> moved task
            <span class="fw-medium">FAQ UX</span> from in
            progress to done board.
          </p>
          <small class="text-muted">Today 7:00 AM</small>
        </div>
      </div>
      <div class="media mb-4 d-flex align-items-start">
        <div class="avatar me-2 flex-shrink-0 mt-1">
          <span class="avatar-initial bg-label-danger rounded-circle">CK</span>
        </div>
        <div class="media-body">
          <p class="mb-0">
            <span class="fw-medium">Clark</span> added new board
            with name <span class="fw-medium">Done</span>.
          </p>
          <small class="text-muted">Yesterday 3:00 PM</small>
        </div>
      </div>
      <div class="media d-flex align-items-center">
        <div class="avatar me-2 flex-shrink-0 mt-1">
          <span class="avatar-initial bg-label-secondary rounded-circle">BW</span>
        </div>
        <div class="media-body">
          <p class="mb-0">
            <span class="fw-medium">Bruce</span> added new task
            in progress board.
          </p>
          <small class="text-muted">Yesterday 12:00 PM</small>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

      </div>
      <!-- / Content -->

      <!-- Footer -->
                <!-- Footer-->
<footer class="content-footer footer bg-footer-theme">
<div class="container-xxl">
<div class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
  <div>
    © <script>
      document.write(new Date().getFullYear())

  </script>
  , made with ❤️ by <a href="https://pixinvent.com/" target="_blank" class="footer-link fw-medium">Pixinvent</a>
  </div>
  <div class="d-none d-lg-inline-block">
    <a href="https://themeforest.net/licenses/standard" class="footer-link me-4" target="_blank">License</a>
    <a href="https://1.envato.market/pixinvent_portfolio" target="_blank" class="footer-link me-4">More Themes</a>
    <a href="https://demos.pixinvent.com/vuexy-html-admin-template/documentation/laravel-introduction.html" target="_blank" class="footer-link me-4">Documentation</a>
    <a href="https://pixinvent.ticksy.com/" target="_blank" class="footer-link d-none d-sm-inline-block">Support</a>
  </div>
</div>
</div>
</footer>
<!--/ Footer-->
                <!-- / Footer -->
      <div class="content-backdrop fade"></div>
    </div>
@endsection

@section('script')
<script src="{{ asset('assets/vendor/libs/jquery/jquery1e84.js?id=0f7eb1f3a93e3e19e8505fd8c175925a') }}"></script>
<script src="{{ asset('assets/vendor/libs/popper/popper0a73.js?id=baf82d96b7771efbcc05c3b77135d24c') }}"></script>
{{-- <script src="{{ asset('assets/vendor/js/bootstraped84.js?id=9a6c701557297a042348b5aea69e9b76') }}"></script> --}}
<script src="{{ asset('assets/vendor/libs/node-waves/node-waves259f.js?id=4fae469a3ded69fb59fce3dcc14cd638') }}"></script>
<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar6188.js?id=44b8e955848dc0c56597c09f6aebf89a') }}"></script>
<script src="{{ asset('assets/vendor/libs/hammer/hammer2de0.js?id=0a520e103384b609e3c9eb3b732d1be8') }}"></script>
<script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead60e7.js?id=f6bda588c16867a6cc4158cb4ed37ec6') }}"></script>
<script src="{{ asset('assets/vendor/js/menu2dc9.js?id=c6ce30ded4234d0c4ca0fb5f2a2990d8') }}"></script>
<script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/jkanban/jkanban.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/quill/katex.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/quill/quill.js') }}"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
{{-- <script src="{{ asset('assets/js/mainf696.js?id=8bd0165c1c4340f4d4a66add0761ae8a') }}"></script> --}}

<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
<script src="{{ asset('assets/js/app-kanban.js') }}"></script>
<!-- END: Page JS-->

<script>

</script>
@endsection
