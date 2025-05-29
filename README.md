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

![image](https://github.com/user-attachments/assets/e1f0a2b9-18b6-4271-9446-a4943ecedab0)
![image](https://github.com/user-attachments/assets/53301c9a-ac5b-4c86-a1ca-492d666830ab)
![image](https://github.com/user-attachments/assets/75e609bd-e9b2-4e96-96fc-84c408bb75e9)

The page features clear options for users to get started as a salon or barber or to book an appointment as a client.


![image](https://github.com/user-attachments/assets/d3f5a13b-4678-4c84-ad8d-8b07fbd75403)
![image](https://github.com/user-attachments/assets/ab649b80-46f6-485e-92a5-ea8c2b9e634d)

This page is the client registration screen for the Appointment Scheduler platform, users can create a client account by entering their name, email, and password, and confirming their password.



![image](https://github.com/user-attachments/assets/a1271f11-fc3e-4423-bd39-22c8169516b6)
![image](https://github.com/user-attachments/assets/5dfbdcbc-d924-4594-9b6d-df47999427a4)

After registering this will appear, the verification link has been sent to email.


![image](https://github.com/user-attachments/assets/df9fd250-8f01-4faa-982f-e0f4e034db5a)

Check the verification link in your spam folder, then click 'Verify Email Address' it will direct you to the login page.


![image](https://github.com/user-attachments/assets/71bcbf7f-cf51-4ece-b616-2f6140deabf2)

This page is the login screen. It allows users to access their accounts by entering their email and password. If users forget their password, they can click the "Forgot your password?". There is also a "Remember me" option for users who want to stay signed in on their device. For new users, the page provides two registration options: one for clients and another for salons or barbers, making it easy for both types of users to create an account and start using the service


![image](https://github.com/user-attachments/assets/9eb0b47c-f5ba-4f9c-aa34-290780abacf7)

This page allows users to reset their password for the Appointment Scheduler platform. If a user has forgotten their password, they can enter their email address into the provided field and click the "Email Password Reset Link" button. The system will then send a password reset link to the entered email address, enabling the user to create a new password and regain access to their account


![image](https://github.com/user-attachments/assets/1d6ca24e-cf07-42af-973f-61347ff2f168)

There’s a notification that the verification link has already been sent to your email


![image](https://github.com/user-attachments/assets/f4e0cf83-0bba-4442-95cb-ef18c4b61ce1)

Again, check the verification link in your spam folder, then click 'Reset Password.' It will direct you to the password reset page.


![image](https://github.com/user-attachments/assets/7ef4874a-eb2a-4beb-89d8-9cbc72337d8d)

This page allows users to reset their password. Users can enter their email address, choose a new password, and confirm the new password in the provided fields. After filling out the form, clicking the "Reset Password" button will update the user's password


![image](https://github.com/user-attachments/assets/84cddd87-ac76-4319-b78c-4389429f9108)
![image](https://github.com/user-attachments/assets/b4c72ecb-16da-4418-8722-604a6eb1b794)

Then, finally, it will take you back to the login page. 


![image](https://github.com/user-attachments/assets/41eb57c8-ec6c-4d74-8734-e20323de943a)

This page is the client dashboard.  It provides users with an overview of their appointment activity, displaying the total number of appointments, upcoming appointments, and completed appointments. The dashboard also features a "Quick Book" option and a prominent "Book Appointment" button, making it easy for users to schedule their first appointment.


![image](https://github.com/user-attachments/assets/2d52355d-f37e-4b51-b11b-18f5281cb743)
![image](https://github.com/user-attachments/assets/3bf60919-58a9-4a47-8edb-6fba9a0d6913)
![image](https://github.com/user-attachments/assets/98c12c04-74b8-4454-b6e9-212a4a2cb3e2)

This page allows clients to book an appointment. Users must first see the shop hours and then can proceed start by selecting a business from the available options. After choosing a business, they can pick a specific service, select a preferred date, and choose a time slot based on availability because it will not accept the appointment if the shop is close. Once all the required fields are filled, the user can confirm their booking by clicking the "Book Appointment" button


![image](https://github.com/user-attachments/assets/a2e00728-adf1-4f38-8613-fb17f8647897)
![image](https://github.com/user-attachments/assets/6f9d3492-9028-47f0-b823-57c488f98887)

The appointment summary on this page provides a clear overview of the booking details before final confirmation. It displays the selected service (Hair Coloring), the duration of the service (90 minutes), the scheduled date and time (Friday, May 23, 2025 at 9:00 AM), and the price (₱1200.00). This summary ensures that clients can review all essential information about their appointment—such as service type, timing, and cost—before completing the booking process


![image](https://github.com/user-attachments/assets/54c31ac7-21b1-4edd-b152-b459b1139d3c)
![image](https://github.com/user-attachments/assets/bb5680dd-ae52-470e-862d-97087df89415)

It shows a list of the user's scheduled appointments, including details such as the service booked (Hair Wash & Scalp Massage), the business name (MJL Shop - Barber Shop), the date and time of the appointment (Friday, May 23, 2025, at 6:30 PM), and the current status (Pending). Users can view more details about each appointment or book a new appointment using the "Book New Appointment" button or also cancel the appointment. This section helps clients easily track and manage their upcoming appointments


![image](https://github.com/user-attachments/assets/19fe6da7-390a-44fa-b364-f0e890ea16e5)

This dashboard page shows an overview of the client’s appointment activity on the Appointment Scheduler platform. At the top, it displays the total number of appointments booked, as well as counts for upcoming and completed appointments. In this case, there is 2 total appointment and 1 upcoming appointment that is today.


![image](https://github.com/user-attachments/assets/655c045d-0958-44ce-98ca-faf46216168d)

The user icon on the dashboard provides quick access to essential account options. When clicked, it opens a menu where users can view and edit their profile or log out of the platform. This feature helps users easily manage their account settings and securely end their session


![image](https://github.com/user-attachments/assets/2e406bab-06cc-46eb-9ea2-0b61622fba3d)
![image](https://github.com/user-attachments/assets/ee87b5d6-57e1-4203-8609-889419716aa8)

This page is the client profile management section of the Appointment Scheduler platform. Here, users can update their profile information by editing their name and email address, and saving the changes. The page also allows users to securely change their password by entering their current password and setting a new one. Additionally, there is an option to permanently delete the account, with a warning to download any important data before proceeding.


![image](https://github.com/user-attachments/assets/ae561b73-b2fd-4d07-b83d-b58f6aa78ef2)
![image](https://github.com/user-attachments/assets/375e379a-31bd-4efc-9730-66fb31444c32)
![image](https://github.com/user-attachments/assets/5f295c3f-7f61-44f8-9a7e-2f3ff891fe57)

The user must provide the correct credentials in order to update the password and for security measures too.


















