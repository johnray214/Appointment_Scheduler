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




SERVICE PROVIDER SIDE

![image](https://github.com/user-attachments/assets/5e054741-d693-402b-bcde-20c7dd9ee0a7)
![image](https://github.com/user-attachments/assets/f71ea95d-3ffc-4c12-8545-05bc01680154)

Clients can log in by entering their email address and password, with an option to stay signed in using the "Remember me" checkbox. If they forget their password, there is a "Forgot your password?" link to help them reset it. There are clear buttons to register as a salon/barber.



![image](https://github.com/user-attachments/assets/9ddc00fd-f394-4403-abaa-49579514665f)
![image](https://github.com/user-attachments/assets/4e9edfdc-c2fb-46d9-84f0-d87b27989476)
![image](https://github.com/user-attachments/assets/366c8cb9-d6d4-42b7-86c1-9ad6ef35c4d7)
![image](https://github.com/user-attachments/assets/f624749a-b0e1-4478-9f44-3a19bc410535)
![image](https://github.com/user-attachments/assets/9b5f9d0a-9102-449d-a352-d92c27d8d82b)

After login the system checks the user if it has a business profile if it doesn’t have it will go this page to lets business owners set up their business profile by entering details like business name, type, description, email, phone, address, and uploading a logo. After filling out the form, they can click "Create Business Profile" to save their information.




![image](https://github.com/user-attachments/assets/111f92dd-35d1-4117-bbe1-dca1a3552a31)
![image](https://github.com/user-attachments/assets/e463653f-87a2-4c7f-bba6-15b876e1afa4)

This page is the business owner’s dashboard on the Appointment Scheduler platform. It displays key stats such as total appointments, today’s appointments, total revenue, and completed appointments. The dashboard also shows the business hours for each day of the week, which are all set to "Closed." There is an option to edit business hours, and below, a section is provided for service usage analytics.



![image](https://github.com/user-attachments/assets/aa2034fc-ffe2-4793-97ae-d752b1b94b52)
![image](https://github.com/user-attachments/assets/b6f11b3b-34b3-42df-8758-4ca1172c413a)

This page show a business hours setup page for an appointment scheduler. The interface allows to set opening and closing times for each day of the week, with the option to mark specific days as "Open" or "Closed.



![image](https://github.com/user-attachments/assets/14ec008f-7e0b-4765-9988-8562a724754c)

The updated dashboard provides a comprehensive overview for service provider, making management easier and more efficient. At the top, key metrics like total appointments, today’s appointments, total revenue, and completed appointments are clearly displayed, helping service provider track business performance. The business hours section allows quick edits, ensuring that operating times are always accurate.



![image](https://github.com/user-attachments/assets/af9d4b50-200c-480e-87cd-5ab105d76097)
![image](https://github.com/user-attachments/assets/8e05d722-022c-447b-9f07-42467a15ae8f)

Visual infographics show service usage, appointment trends, and popular services, helping service provider identify which services are most in demand and spot busy days. The dashboard also lists today’s appointments with client details and statuses, allowing for smooth daily operations.




![image](https://github.com/user-attachments/assets/0da8dd3d-d25b-4d10-b240-711367ec32d2)
![image](https://github.com/user-attachments/assets/2b0f7fd6-ea88-42c4-9659-37b2a2d22b46)

The image shows the appointments page from Dwayne Cosello's Appointment Scheduler system. This service provider -side interface displays a list of upcoming and past appointments in a well-organized table format with columns for Date & Time, Client, Service, Status, and a View option.



![image](https://github.com/user-attachments/assets/3800c4a7-0b09-4319-9462-73407d43c7ec)
![image](https://github.com/user-attachments/assets/a0593448-f934-4101-831c-bad3ea7d0c0a)

The Appointment Details page provides a clear summary of a specific booking. It displays the customer’s name and email, the service booked, duration, price, and the scheduled date and time. Then it also has the button to Confirm the appointment or cancel it.



![image](https://github.com/user-attachments/assets/c9aed129-386e-4048-a65a-c2baecbbc886)
![image](https://github.com/user-attachments/assets/b9609362-ad66-4bac-9ea0-f95e40b52608)

The Services page allows service provider to manage all offered services in one place. Each service is listed with its name, duration, price, and visibility status (either "Visible" or "Hidden"). service provider can easily edit or delete services as needed, or add new ones with the "Add New Service" button.



![image](https://github.com/user-attachments/assets/8d394c87-7cc9-44b0-8f6a-aa7c253b2b0a)
![image](https://github.com/user-attachments/assets/c70e40c7-7444-4707-a22f-85f6e4528023)

This page lets service provider add a new service, like "Hair Extension," by entering its name, description, price, and duration. There’s also an option to make the service visible to clients for booking. 



![image](https://github.com/user-attachments/assets/85bcd0e0-9dc3-4312-9558-a6a13871460d)
![image](https://github.com/user-attachments/assets/4c40f73b-febd-4ab4-947e-5595c08d9f98)

Service provider can edit business profile



![image](https://github.com/user-attachments/assets/af4ca1a5-2212-46b9-9f71-96ae62bea640)
![image](https://github.com/user-attachments/assets/5de9b149-8412-4a02-a9c7-0648ad2c4d99)
![image](https://github.com/user-attachments/assets/3c96ef1e-ed46-4881-bba3-ce6c830aac6d)

Shop owner can update their profile information by editing their name and email address, and saving the changes. The page also allows users to securely change their password by entering their current password and setting a new one. Additionally, there is an option to permanently delete the account, with a warning to download any important data before proceeding.



MOBILE VIEW:

CLIENT SIDE

![image](https://github.com/user-attachments/assets/675a5c69-de9c-4833-a094-f28e2e6da820)
![image](https://github.com/user-attachments/assets/00cc72c5-3d46-4fb1-8b38-65ed92247a1c)
![image](https://github.com/user-attachments/assets/af631a87-ba14-4456-a073-b33cfb6c8100)
![image](https://github.com/user-attachments/assets/0c0b23d1-819a-46aa-976b-99c6ccf3692e)
![image](https://github.com/user-attachments/assets/d5af94bb-17f5-4398-879b-997cd0f5bd26)
![image](https://github.com/user-attachments/assets/7496a43f-caee-4c3c-bbad-02eee5c4d464)



SERVICE PROVIDER:

![image](https://github.com/user-attachments/assets/e0bed9b1-bb51-4dab-bec7-dd8d66b04234)
![image](https://github.com/user-attachments/assets/53cabcbf-8272-4670-aa08-a4684d065f6d)
![image](https://github.com/user-attachments/assets/43d2fd33-ae7c-41fa-910b-9f93bfaa1697)
![image](https://github.com/user-attachments/assets/bf99276b-f936-4ff9-9ca6-54dec29eb068)
![image](https://github.com/user-attachments/assets/03409511-593b-41a7-859f-08ef9898aa2c)
![image](https://github.com/user-attachments/assets/b64e4e22-0825-4c51-b56d-a8d80bbee979)
![image](https://github.com/user-attachments/assets/cfa92074-a8ca-4d80-b6c9-845a3bf8dcc1)
![image](https://github.com/user-attachments/assets/6f21c06d-9aad-45fa-81b0-401dae805953)
![image](https://github.com/user-attachments/assets/cc54f356-6deb-4897-ad3b-aade630d5da7)
![image](https://github.com/user-attachments/assets/f9524370-d91d-44b9-b652-dc06bc09d771)
![image](https://github.com/user-attachments/assets/bf8fb96b-58cf-4983-9164-a1dabde8ae63)





















