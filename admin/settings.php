<?php
include('../config/config.php');
secure();

// Assuming you have the user ID from the session
$user_id = isset($_SESSION['id']) ? $_SESSION['id'] : null;  // Get user ID from session

if (!$user_id) {
    echo "User ID not provided.";
    exit;
}

// Fetch current user data from the database
$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($connect, $query);
if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "User not found!";
    exit;
}

// Process the form submission for updating user data
if (isset($_POST['first'])) {

    // Check if all required fields are filled
    if ($_POST['first'] && $_POST['last'] && $_POST['email'] && $_POST['phone'] && $_POST['description'] && $_POST['city'] && $_POST['degree'] && $_POST['website'] && $_POST['title_small'] && $_POST['title_main'] && $_POST['dob'] && isset($_POST['freelance'])) {
      
        $photoPath = $user['image']; // Keep current photo path if no new photo is uploaded
        $audioPath = $user['audio']; // Keep current audio path if no new audio is uploaded

        // Check if a new photo is uploaded
        if (!empty($_FILES['image']['name'])) {
            $uploadDir = 'uploads/';
            $fileExt = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION); // Get file extension
            $randomFileName = uniqid('img_') . '.' . $fileExt; // Generate a unique random filename
            $targetFile = $uploadDir . $randomFileName;

            // Ensure the uploads directory exists
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Move the uploaded file
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                $photoPath = $targetFile; // Update the photo path if a new file was uploaded
            } else {
                echo "Error uploading file.";
                die(); // Stop script if file upload fails
            }
        }

        // Check if a new audio file is uploaded
        if (!empty($_FILES['audio']['name'])) {
            $audioDir = 'uploads/audio/';
            $audioExt = pathinfo($_FILES['audio']['name'], PATHINFO_EXTENSION); // Get file extension
            $randomAudioName = uniqid('audio_') . '.' . $audioExt; // Generate a unique random filename
            $audioTargetFile = $audioDir . $randomAudioName;

            // Ensure the audio uploads directory exists
            if (!is_dir($audioDir)) {
                mkdir($audioDir, 0777, true);
            }

            // Move the uploaded audio file
            if (move_uploaded_file($_FILES['audio']['tmp_name'], $audioTargetFile)) {
                $audioPath = $audioTargetFile; // Update the audio path if a new file was uploaded
            } else {
                echo "Error uploading audio file.";
                die(); // Stop script if file upload fails
            }
        }

        // Update existing user in the database
        $query = "UPDATE users SET 
            first_name = '" . mysqli_real_escape_string($connect, $_POST['first']) . "',
            last_name = '" . mysqli_real_escape_string($connect, $_POST['last']) . "',
            designation = '" . mysqli_real_escape_string($connect, $_POST['designation']) . "',
            email = '" . mysqli_real_escape_string($connect, $_POST['email']) . "',
            phone = '" . mysqli_real_escape_string($connect, $_POST['phone']) . "',
            description = '" . mysqli_real_escape_string($connect, $_POST['description']) . "',
            city = '" . mysqli_real_escape_string($connect, $_POST['city']) . "',
            degree = '" . mysqli_real_escape_string($connect, $_POST['degree']) . "',
            website = '" . mysqli_real_escape_string($connect, $_POST['website']) . "',
            linkedin = '" . mysqli_real_escape_string($connect, $_POST['linkedin']) . "',
            instagram = '" . mysqli_real_escape_string($connect, $_POST['instagram']) . "',
            facebook = '" . mysqli_real_escape_string($connect, $_POST['website']) . "',
            twitter = '" . mysqli_real_escape_string($connect, $_POST['twitter']) . "',
            title_small = '" . mysqli_real_escape_string($connect, $_POST['title_small']) . "',
            title_main = '" . mysqli_real_escape_string($connect, $_POST['title_main']) . "',
            dob = '" . mysqli_real_escape_string($connect, $_POST['dob']) . "',
            freelance = '" . mysqli_real_escape_string($connect, $_POST['freelance']) . "',
            image = '" . mysqli_real_escape_string($connect, $photoPath) . "',
            audio = '" . mysqli_real_escape_string($connect, $audioPath) . "'
            WHERE id = '$user_id'";

        if (mysqli_query($connect, $query)) {
            set_message('Settings has been updated successfully');
        } else {
            echo "Error: " . mysqli_error($connect);
        }

        header('Location: dashboard.php');
        die();
    } else {
        echo "Please fill in all required fields.";
    }
}

include('includes/header.php');
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="main-admin">
  <div class="pt-3 pb-2 mb-3">
    <h1 class="h2">Settings</h1>
  </div>

  <form method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="col-md-4 form-group mb-3">
        <label for="first">First Name:</label>
        <input type="text" name="first" id="first" class="form-control" value="<?php echo htmlspecialchars($user['first_name']); ?>" placeholder="First Name" required>
      </div>
      <div class="col-md-4 form-group mb-3">
        <label for="last">Last Name:</label>
        <input type="text" name="last" id="last" class="form-control" value="<?php echo htmlspecialchars($user['last_name']); ?>" placeholder="Last Name" required>
      </div>
      <div class="col-md-4 form-group mb-3">
        <label for="designation">Designation:</label>
        <input type="text" name="designation" id="designation" class="form-control" value="<?php echo htmlspecialchars($user['designation']); ?>" placeholder="Designation" required>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 form-group mb-3">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" placeholder="Email" required>
      </div>
      <div class="col-md-6 form-group mb-3">
        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone" class="form-control" value="<?php echo htmlspecialchars($user['phone']); ?>" placeholder="Phone" required>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 form-group mb-3">
        <label for="title_small">Title Small:</label>
        <input type="title_small" name="title_small" id="title_small" class="form-control" value="<?php echo htmlspecialchars($user['title_small']); ?>" placeholder="Title Small" required>
      </div>
      <div class="col-md-6 form-group mb-3">
        <label for="title_main">Title Main:</label>
        <input type="text" name="title_main" id="title_main" class="form-control" value="<?php echo htmlspecialchars($user['title_main']); ?>" placeholder="Title Main" required>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 form-group mb-3">
        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="5" class="form-control" placeholder="Description"><?php echo htmlspecialchars($user['description']); ?></textarea>
      </div>
    </div>      

    <div class="row">
      <div class="col-md-6 form-group mb-3">
        <label for="city">City:</label>
        <input type="text" name="city" id="city" class="form-control" value="<?php echo htmlspecialchars($user['city']); ?>" placeholder="City" required>
      </div>
      <div class="col-md-6 form-group mb-3">
        <label for="degree">Degree:</label>
        <input type="text" name="degree" id="degree" class="form-control" value="<?php echo htmlspecialchars($user['degree']); ?>" placeholder="Degree" required>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 form-group mb-3">
        <label for="website">Website:</label>
        <input type="text" name="website" id="website" class="form-control" value="<?php echo htmlspecialchars($user['website']); ?>" placeholder="Website" required>
      </div>
      <div class="col-md-6 form-group mb-3">
        <label for="dob">Date of Birth:</label>
        <input type="date" name="dob" id="dob" class="form-control" value="<?php echo $user['dob']; ?>" required>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 form-group mb-3">
        <label for="linkedin">LinkedIn:</label>
        <input type="text" name="linkedin" id="linkedin" class="form-control" value="<?php echo htmlspecialchars($user['linkedin']); ?>" placeholder="LinkedIn" required>
      </div>
      <div class="col-md-6 form-group mb-3">
        <label for="instagram">Instagram:</label>
        <input type="text" name="instagram" id="instagram" class="form-control" value="<?php echo $user['instagram']; ?>" placeholder="Instagram" required>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 form-group mb-3">
        <label for="facebook">Facebook:</label>
        <input type="text" name="facebook" id="facebook" class="form-control" value="<?php echo htmlspecialchars($user['facebook']); ?>" placeholder="Facebook" required>
      </div>
      <div class="col-md-6 form-group mb-3">
        <label for="twitter">Twitter:</label>
        <input type="text" name="twitter" id="twitter" class="form-control" value="<?php echo $user['twitter']; ?>" placeholder="Twitter" required>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 form-group mb-3">
        <label for="freelance">Are you available for freelancing?</label>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="freelance" id="yes" value="1" <?php echo $user['freelance'] == '1' ? 'checked' : ''; ?> required>
          <label class="form-check-label" for="yes">Yes</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="freelance" id="no" value="0" <?php echo $user['freelance'] == '0' ? 'checked' : ''; ?> required>
          <label class="form-check-label" for="no">No</label>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="audio">Audio:</label>
        <input type="file" name="audio" id="audio" class="form-control mb-3">
        <?php if (!empty($user['audio'])): ?>
          <audio controls>
            <source src="<?php echo $user['audio']; ?>" type="audio/mpeg">
            Your browser does not support the audio element.
          </audio>
        <?php endif; ?>
      </div>

      <div class="col-md-6 mb-3">
        <label for="image">Photo:</label>
        <input type="file" name="image" id="image" class="form-control mb-3">
        <?php if (!empty($user['image'])): ?>
          <img src="<?php echo $user['image']; ?>" alt="User Photo" width="100">
        <?php endif; ?>
      </div>
    </div>

    <div class="mb-3 text-center">
      <a href="dashboard.php" class="btn btn-secondary"><i class="fas fa-arrow-circle-left"></i> Return to Dashboard</a>
      <input type="submit" class="btn btn-primary" value="Update">
    </div>
  </form>
</main>

<?php
include('includes/footer.php');
?>
