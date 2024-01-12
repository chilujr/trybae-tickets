<?php 
require_once "includes/sessions.php"; 
require_once "includes/header.php"; 
?>


  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <?php require_once "includes/menu.php"; ?>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <?php require_once "includes/nav.php"; ?>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Action /</span> Edit Story</h4>

              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-plus me-1"></i> Edit Story</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="view-posts.php"
                        ><i class="bx bx-bell me-1"></i>View Story</a
                      >
                    </li>
                  </ul>
                  <div class="card mb-4">
                    <h5 class="card-header">Story's Content</h5>
                    <!-- Account -->
                    <hr class="my-0" />
                    <div class="card-body">
                    <form action="includes/stories_api.php" method="POST" enctype="multipart/form-data">

                    <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Event Name</label>
                            <input
                              class="form-control"
                              type="text"
                              id="event_name"
                              name="event_name"
                              placeholder="Oasis Fest"
                              autofocus
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Address" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Event Organizers</label>
                            <input class="form-control" type="text" name="event_org" id="event_org" placeholder="Event Organizers" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input
                              class="form-control"
                              type="text"
                              id="4"
                              name="email"
                              placeholder="john.doe@example.com"
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">Phone Number</label>
                            <div class="input-group input-group-merge">
                              <span class="input-group-text">ZM (+260)</span>
                              <input
                                type="text"
                                id="phoneNumber"
                                name="phone_number"
                                class="form-control"
                                placeholder="095 225 0101"
                              />
                            </div>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber">Ticket Numbers</label>
                            <input class="form-control" type="text" id="limits" name="limits" placeholder="Enter Number of Available Tickets" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber">Age Restrictions</label>
                            <select class="select2 form-select" name="age_id" id="age" required>
                              <option value="">Select age</option>
                              <?php foreach ($ages as $key => $age): ?>
                                <?php if (!empty($age_id) && $age_id == $age['id']): ?>
                                  <option selected value="<?php echo $age['id']?>">  <?php echo $age['age']?> </option>
                                <?php else: ?>
                                  <option value="<?php echo $age['id']?>">  <?php echo $age['age']?> </option>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">Province</label>
                            <option value="">Select City</option>
                            <select class="select2 form-select" name="city_id" id="city" required>
                              <?php foreach ($citys as $key => $city): ?>
                                <?php if (!empty($city_id) && $city_id == $city['id']): ?>
                                  <option selected value="<?php echo $city['id']?>">  <?php echo $city['city']?> </option>
                                <?php else: ?>
                                  <option value="<?php echo $city['id']?>">  <?php echo $city['city']?> </option>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="date" class="form-label">Date</label>
                            <input class="form-control" type="date" name="dates" required>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="timeZones" class="form-label">Time</label>
                            <input class="form-control" type="time" name="times"  required>
                          </div>
                          <div class="col-md-8">
                          <h5 class="card-header">Ticket Prices</h5>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="zipCode" class="form-label">Ordinary</label>
                            <input class="form-control" type="text" id="price" name="ordinary" placeholder="Enter Ordinary price" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="zipCode" class="form-label">V.I.P</label>
                            <input class="form-control" type="text" id="price" name="vip" placeholder="Enter VIP price" />
                          </div>
                        </div>
                        <div class="row">
                        <div class="mb-3 col-md-6">
                              <label for="organization" class="form-label">Additional Information</label>
                              <input class="form-control" type="file" id="image" name="event_image" placeholder="Select Image" />
                          </div>
                          <div class="mb-3 col-md-6">
                              <label for="organization" class="form-label">Additional Information</label>
                              <textarea
                                type="text"
                                class="form-control"
                                id="Additional"
                                name="add_info"
                                placeholder="Additional Information"
                              ></textarea>
                          </div>

                          <div class="mb-3 col-md-6">
                            <?php if (empty($published) && $published == "0"): ?>
                              <label for="publishing">
                                <input type="checkbox" name="published">
                                Publish this post?
                              </label>
                              <?php else: $published == "1" ?>
                              <label for="publishing">
                                <input type="checkbox" name="published" checked>
                                Publish this post?
                              </label>
                            <?php endif; ?>
                          </div>
                          
                          <div class="mt-2">
                            <button type="submit" name="update-story" class="btn btn-primary me-2">Save changes</button>
                            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <?php require_once "includes/footer.php"; ?>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js ../assets/vendor/js/core.js -->
    <script src="assets/vendor/libs/jquery/jquery.js"></script>
    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="assets/vendor/js/menu.js"></script>
    <!-- endbuild -->
    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="assets/js/pages-account-settings-account.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
        
  </body>
</html>
