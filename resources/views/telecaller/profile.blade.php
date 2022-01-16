@extends('layouts.telecaller')

@section('content')

<div class="profile-page tx-13">
    <div class="row">
      <div class="col-12 grid-margin">
                      <div class="profile-header">
                          <div class="cover">
                              <div class="gray-shade"></div>
                              <figure>
                                  <img src="https://via.placeholder.com/1148x272" class="img-fluid" alt="profile cover">
                              </figure>
                              <div class="cover-body d-flex justify-content-between align-items-center">
                                  <div>
                                      <img class="profile-pic" src="https://via.placeholder.com/100x100" alt="profile">
                                      <span class="profile-name">{{Auth::user()->name}}</span>
                                      <span class="profile-email">{{Auth::user()->email}}</span>
                                  </div>
                                  <div class="d-none d-md-block">
                                      <button class="btn btn-primary btn-icon-text btn-edit-profile">
                                          <i data-feather="edit" class="btn-icon-prepend"></i> Edit profile
                                      </button>
                                  </div>
                              </div>
                          </div>
                          <div class="header-links">
                              <ul class="links d-flex align-items-center mt-3 mt-md-0">
                                  <li class="header-link-item d-flex align-items-center active">
                                  </li>
                                  <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                                  </li>
                                  <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                                      
                                  </li>
                                  <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                                      
                                  </li>
                                  <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                                      
                                  </li>
                              </ul>
                          </div>
          </div>
    
@endsection