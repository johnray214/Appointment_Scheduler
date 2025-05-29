Appointment Scheduler

The Appointment Scheduler for Salons & Barbers is a comprehensive web-based scheduling platform designed to streamline appointment booking and client management for salon and barbershop businesses. The system offers dual functionality—serving both clients and service providers—with intuitive dashboards, real-time appointment booking, service tracking, and profile customization features.

To manage user registration, login, password resets, and email verification, the system uses Laravel Breeze, a lightweight starter kit that provides built-in authentication features using Blade templates and Tailwind CSS. Breeze ensures a secure and modular foundation for managing both client and service provider accounts, supporting features like email verification, profile management, and password reset functionality.

Purpose and Benefits

The core goal of the system is to:
•	Simplify the booking process for clients.
•	Help service providers efficiently manage appointments, services, and business hours.
•	Ensure seamless user experience with secure authentication and real-time features.

User Types

1.	Clients – Individuals who can:
o	Register/login securely
o	Book and manage appointments
o	View appointment history
o	Edit their profile and change password

2.	Service Providers (Salon/Barber Shop Owners) – Users who can:
o	Register/login securely
o	Create and manage their business profile
o	Set business hours
o	Add/manage services
o	View analytics on appointments and services
o	Handle appointment confirmations or cancellations


 
 

CLIENT SIDE























 









The page features clear options for users to get started as a salon or barber or to book an appointment as a client.


















This page is the client registration screen for the Appointment Scheduler platform, users can create a client account by entering their name, email, and password, and confirming their password.


















After registering this will appear, the verification link has been sent to email.










Check the verification link in your spam folder, then click 'Verify Email Address' it will direct you to the login page.









This page is the login screen. It allows users to access their accounts by entering their email and password. If users forget their password, they can click the "Forgot your password?". There is also a "Remember me" option for users who want to stay signed in on their device. For new users, the page provides two registration options: one for clients and another for salons or barbers, making it easy for both types of users to create an account and start using the service










This page allows users to reset their password for the Appointment Scheduler platform. If a user has forgotten their password, they can enter their email address into the provided field and click the "Email Password Reset Link" button. The system will then send a password reset link to the entered email address, enabling the user to create a new password and regain access to their account





 






There’s a notification that the verification link has already been sent to your email










Again, check the verification link in your spam folder, then click 'Reset Password.' It will direct you to the password reset page.

 
This page allows users to reset their password. Users can enter their email address, choose a new password, and confirm the new password in the provided fields. After filling out the form, clicking the "Reset Password" button will update the user's password 



















Then, finally, it will take you back to the login page. 











This page is the client dashboard.  It provides users with an overview of their appointment activity, displaying the total number of appointments, upcoming appointments, and completed appointments. The dashboard also features a "Quick Book" option and a prominent "Book Appointment" button, making it easy for users to schedule their first appointment.

















	This page allows clients to book an appointment. Users must first see the shop hours and then can proceed start by selecting a business from the available options. After choosing a business, they can pick a specific service, select a preferred date, and choose a time slot based on availability because it will not accept the appointment if the shop is close. Once all the required fields are filled, the user can confirm their booking by clicking the "Book Appointment" button





















	The appointment summary on this page provides a clear overview of the booking details before final confirmation. It displays the selected service (Hair Coloring), the duration of the service (90 minutes), the scheduled date and time (Friday, May 23, 2025 at 9:00 AM), and the price (₱1200.00). This summary ensures that clients can review all essential information about their appointment—such as service type, timing, and cost—before completing the booking process


















	It shows a list of the user's scheduled appointments, including details such as the service booked (Hair Wash & Scalp Massage), the business name (MJL Shop - Barber Shop), the date and time of the appointment (Friday, May 23, 2025, at 6:30 PM), and the current status (Pending). Users can view more details about each appointment or book a new appointment using the "Book New Appointment" button or also cancel the appointment. This section helps clients easily track and manage their upcoming appointments.








	This dashboard page shows an overview of the client’s appointment activity on the Appointment Scheduler platform. At the top, it displays the total number of appointments booked, as well as counts for upcoming and completed appointments. In this case, there is            2 total appointment and 1 upcoming appointment that is today.










	The user icon on the dashboard provides quick access to essential account options. When clicked, it opens a menu where users can view and edit their profile or log out of the platform. This feature helps users easily manage their account settings and securely end their session






















	This page is the client profile management section of the Appointment Scheduler platform. Here, users can update their profile information by editing their name and email address, and saving the changes. The page also allows users to securely change their password by entering their current password and setting a new one. Additionally, there is an option to permanently delete the account, with a warning to download any important data before proceeding.
 
  

The user must provide the correct credentials in order to update the password and for security measures too.



SERVICE PROVIDER SIDE













	


Clients can log in by entering their email address and password, with an option to stay signed in using the "Remember me" checkbox. If they forget their password, there is a "Forgot your password?" link to help them reset it. There are clear buttons to register as a salon/barber.






	











































After login the system checks the user if it has a business profile if it doesn’t have it will go this page to lets business owners set up their business profile by entering details like business name, type, description, email, phone, address, and uploading a logo. After filling out the form, they can click "Create Business Profile" to save their information.








This page is the business owner’s dashboard on the Appointment Scheduler platform. It displays key stats such as total appointments, today’s appointments, total revenue, and completed appointments. The dashboard also shows the business hours for each day of the week, which are all set to "Closed." There is an option to edit business hours, and below, a section is provided for service usage analytics.









This page show a business hours setup page for an appointment scheduler. The interface allows to set opening and closing times for each day of the week, with the option to mark specific days as "Open" or "Closed.











	The updated dashboard provides a comprehensive overview for service provider, making management easier and more efficient. At the top, key metrics like total appointments, today’s appointments, total revenue, and completed appointments are clearly displayed, helping service provider track business performance. The business hours section allows quick edits, ensuring that operating times are always accurate.
 
              Visual infographics show service usage, appointment trends, and popular services, helping service provider identify which services are most in demand and spot busy days. The dashboard also lists today’s appointments with client details and statuses, allowing for smooth daily operations.










The image shows the appointments page from Dwayne Cosello's Appointment Scheduler system. This service provider -side interface displays a list of upcoming and past appointments in a well-organized table format with columns for Date & Time, Client, Service, Status, and a View option.
















The Appointment Details page provides a clear summary of a specific booking. It displays the customer’s name and email, the service booked, duration, price, and the scheduled date and time. Then it also has the button to Confirm the appointment or cancel it.

















The Services page allows service provider to manage all offered services in one place. Each service is listed with its name, duration, price, and visibility status (either "Visible" or "Hidden"). service provider can easily edit or delete services as needed, or add new ones with the "Add New Service" button. 










This page lets service provider add a new service, like "Hair Extension," by entering its name, description, price, and duration. There’s also an option to make the service visible to clients for booking. 



















		Service provider can edit business profile
 



















	Shop owner can update their profile information by editing their name and email address, and saving the changes. The page also allows users to securely change their password by entering their current password and setting a new one. Additionally, there is an option to permanently delete the account, with a warning to download any important data before proceeding.
 
MOBILE VIEW:
CLIENT SIDE
 
   













SERVICE PROVIDER:
 

 
