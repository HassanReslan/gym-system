<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gym Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">  
  <!-- For Font Awesome 6 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{asset('css\app.css')}}">
  <style>
   
    
  </style>
</head>
<body>
    @include('layouts.sidebar')
  <div class="main">
    <div class="top-bar">
      <h1>Welcome Back!</h1>
      <img src="https://i.pravatar.cc/40" alt="User" class="avatar">
    </div>

    <div class="cards">
      <div class="card">
        <h3>824</h3>
        <p>Active Members</p>
      </div>
      <div class="card">
        <h3>16</h3>
        <p>Pending Payments</p>
      </div>
      <div class="card">
        <h3>25</h3>
        <p>New Registrations</p>
      </div>
      <div class="card">
        <h3>$12,450</h3>
        <p>Total Revenue</p>
      </div>
    </div>

    <div class="recent">
      <h3>Recent Activity</h3>
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Membership</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="user-info"><img class="avatar" src="https://i.pravatar.cc/30?img=1"> Annette Black</td>
            <td>Gold</td>
            <td><span class="status active">Active</span></td>
          </tr>
          <tr>
            <td class="user-info"><img class="avatar" src="https://i.pravatar.cc/30?img=2"> Kathryn Murphy</td>
            <td>Basic</td>
            <td><span class="status overdue">Overdue</span></td>
          </tr>
          <tr>
            <td class="user-info"><img class="avatar" src="https://i.pravatar.cc/30?img=3"> Guy Hawkins</td>
            <td>Premium</td>
            <td><span class="status active">Active</span></td>
          </tr>
          <tr>
            <td class="user-info"><img class="avatar" src="https://i.pravatar.cc/30?img=4"> Cody Fischer</td>
            <td>Gold</td>
            <td><span class="status active">Active</span></td>
          </tr>
          <tr>
            <td class="user-info"><img class="avatar" src="https://i.pravatar.cc/30?img=5"> Dariene Roberts</td>
            <td>Basic</td>
            <td><span class="status inactive">Inactive</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
