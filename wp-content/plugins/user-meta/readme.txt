=== Plugin Name ===
Contributors: khaledsaikat
Donate link: http://wordpress-extend.com
Tags: user, profile, registration, login, frontend, users, usermeta, import, csv, upload, AJAX, admin, plugin, page, image, images, photo, picture, file, email, shortcode, captcha, avatar, redirect, register, password, custom
Requires at least: 3.0.0
Tested up to: 3.3.1
Stable tag: 1.1.0

Frontend user profile, registration and login with extra fields.

== Description ==

<p>Frontend user profile, registration and login with extra fields. Allow user to register and login by email.</p>

<p>List of supported fields :</p>
<p><strong>Default WordPress Fields</strong></p>
<ul>
<li>Username</li>
<li>Email</li>
<li>Password</li>
<li>Website</li>
<li>Display Name</li>
<li>Nickname</li>
<li>First Name</li>
<li>Last Name</li>
<li>Biographical Info</li>
<li>Registration Date</li>
<li>Role</li>
<li>Jabber</li>
<li>Aim</li>
<li>Yim</li>
<li>Avatar</li>
</ul>
<p><strong>Extra Fields</strong></p>
<ul>
<li>TextBox</li>
<li>Paragraph</li>
<li>Rich Text</li>
<li>Hidden Field</li>
<li>DropDown</li>
<li>CheckBox</li>
<li>Select One (radio)</li>
<li>Date /Time</li>
<li>Password</li>
<li>Email</li>
<li>File Upload</li>
<li>Image Url</li>
<li>Phone Number</li>
<li>Number</li>
<li>Website</li>
<li>Country</li>
</ul>
<p><strong>Formatting Fields</strong></p>
<ul>
<li>Page Heading</li>
<li>Section Heading</li>
<li>HTML</li>
<li>Captcha</li>
</ul>


<p>You can create unlimited number of fields. All newly created field's data will save to WordPress default usermeta table. so you can retrieve all user data by calling wordpress default functions(e.g. get_userdata(), get_user_meta() ). User Meta plugin separates fields and forms. So, a single field can be used among several forms. </p>


<div class="inside">
            <h4>3 steps to getting started</h4><p><b>Step 1. </b>Create Field from User Meta >> Fields Editor.</p><p><b>Step 2. </b>Go to User Meta >> Forms Editor, Give a name to your form. Drag and drop fields from right to left and save the form.</p><p><b>Step 3. </b>write shortcode to your page or post. e.g.: Shortcode: [user-meta type='profile' form='your_form_name']</p><p></p>
        </div>


<p><strong>N.B.</strong> Registration, login and some extra fields are only supported in pro version. Get <a href='http://wordpress-extend.com'>User Meta Pro</a></p>


== Installation ==

1. Upload and extract `user-meta.zip` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress


== Screenshots ==

1. Fields Editor
2. Forms Field selector
3. Frontend Profile
4. Frontend Login

== Changelog ==

= 1.1.0 =
* Include first version of User Meta Pro
* Pro: added more fields type
* Pro: Frontend Registration
* Pro: Frontend Login

= 1.0.5 =
* Changing complete structure
* Make Seperation of fields and form, so one field can be use in many form
* Add verious type of fields
* Added dragable fields to form
* Improve frontend profile

= 1.0.3 =
* Extend Import Functionality
* Draggable Meta Field
* Add Donation Button

= 1.0.2 =
* Optimize code using php class.
* add [user-meta-profile] shortcode support.

= 1.0.1 =
* Some Bug Free.

= 1.0 =
* First version.

== Upgrade Notice ==

= 1.1.0 =
* Introduce with User Meta Pro.

= 1.0.5 =
* Added new fields with new look and feel also functionality.