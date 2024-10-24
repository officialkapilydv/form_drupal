
---

# Drupal Form Submission Project

This project is a custom Drupal module that creates a form connected to a database. Users can fill in their details using the form, and upon submission, the data is saved to a database. After submission, the user is redirected to a page that displays all stored submissions from the database.

## Table of Contents

- [Installation](#installation)
- [Features](#features)
- [Requirements](#requirements)
- [Usage](#usage)
- [Customization](#customization)
- [Troubleshooting](#troubleshooting)
- [Contributing](#contributing)
- [License](#license)

## Installation

1. **Download Drupal**: Make sure you have a Drupal site installed and running. You can download the latest version from [Drupal's official website](https://www.drupal.org/).

2. **Enable the Custom Module**:
   - Create a new custom module directory under the `modules/custom` folder of your Drupal installation. 
   - Clone this repository into that folder:
     ```bash
     git clone <https://github.com/officialkapilydv/form_drupal> modules/custom/my_custom_form
     ```
   - Navigate to the Drupal admin panel and enable the custom module:
     - Go to `Extend`.
     - Search for "My Custom Form Module" and enable it.

3. **Database Setup**:
   - Ensure your Drupal installation is connected to a database.
   - Create a database table that will store the form submissions:
     ```sql
     CREATE TABLE custom_form_submissions (
       id INT PRIMARY KEY AUTO_INCREMENT,
       name VARCHAR(255),
       email VARCHAR(255),
       message TEXT,
       submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
     );
     ```

4. **Clear Cache**: Go to `Configuration -> Performance` and clear all caches.

## Features

- A simple form for collecting user details (e.g., name, email, and a message).
- Form submissions are stored in a custom database table.
- A results page displays all stored submissions.
- Easy to customize form fields and submission logic.

## Requirements

- Drupal 9.x or later
- PHP 7.4 or later
- MySQL or another supported database
- Basic knowledge of Drupal module development

## Usage

1. **Access the Form**:
   - Go to the form page URL: `/my-custom-form`.
   - Fill in the details and submit.

2. **View Submissions**:
   - After submission, you will be redirected to a page displaying all previous submissions.
   - To view the submissions directly, go to `/my-custom-form/submissions`.

## Customization

### Changing Form Fields

To customize the form fields, you can modify the form structure in the module's code:

1. Open the file `src/Form/CustomForm.php`.
2. Adjust the fields in the `buildForm()` method as needed.

### Alter Database Table

If you need to change the database schema (e.g., to add new fields):

1. Update the database table using SQL commands.
2. Modify the module's `submitForm()` function to save additional fields.
3. Update the results page to display any new data fields.

## Troubleshooting

- **Form Not Showing**: Make sure the module is enabled in the `Extend` section of the admin panel.
- **Database Errors**: Check if the database table exists and has the correct structure.
- **Form Data Not Saving**: Verify database permissions for your Drupal database user.
- **Page Not Found**: Make sure you have cleared the Drupal cache after installing the module.

## Contributing

Contributions are welcome! If you'd like to contribute:

1. Fork the repository.
2. Create a feature branch: `git checkout -b feature/my-feature`.
3. Commit your changes: `git commit -am 'Add my feature'`.
4. Push to the branch: `git push origin feature/my-feature`.
5. Open a Pull Request.

## License

This project is licensed under the MIT License - see the LICENSE file for details.

---
