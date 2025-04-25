<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Variabel Filter
$authFilter = ['filter' => 'auth'];

// Variabel Role
$admin      = ['filter' => 'role:admin'];
$user  = ['filter' => 'role:user'];
$allRole    = ['filter' => 'role:admin,user'];

// Login
$routes->get('/login', 'Auth::login');
$routes->post('/proses-login', 'Auth::prosesLogin');
$routes->get('/logout', 'Auth::logout');

// Backup db
$routes->get('/backup', 'Backup::database');
$routes->get('/lay', 'Home::index');

// Halaman utama
$routes->get('/', 'Home::index', $authFilter);
$routes->get('/dashboard', 'Home::index', $authFilter);
$routes->get('about', 'Home::about', $allRole);

// tugas
$routes->get('tugas', 'tugas::index');
$routes->get('tugas/create', 'tugas::create');
$routes->post('tugas/store', 'tugas::store');
$routes->get('tugas/edit/(:num)', 'tugas::edit/$1');
$routes->post('tugas/update/(:num)', 'Tugas::update/$1');
$routes->post('tugas/ubahStatus/(:num)', 'Tugas::ubahStatus/$1');
$routes->get('tugas/delete/(:num)', 'tugas::delete/$1');
$routes->get('tugas/detail/(:num)', 'Tugas::detail/$1');
$routes->post('tugas/upload/(:num)', 'Tugas::upload/$1');


// Routes untuk berbagi tugas
$routes->get('tugas/sharedtome/(:num)', 'Tugas::sharedToMe/$1'); // Halaman tugas yang dibagikan ke pengguna
$routes->post('tugas/shareTaskToFriend/(:num)', 'Tugas::shareTaskToFriend/$1'); // Proses berbagi tugas ke teman
$routes->get('tugas/share/(:num)', 'Tugas::share/$1'); // Halaman untuk memilih teman/grup yang akan dibagikan tugas
$routes->post('tugas/processShare/(:num)', 'Tugas::processShare/$1');
$routes->get('/sharedtome', 'Tugas::sharedToMe');

//user
$routes->get('user', 'user::index');
$routes->get('user/create', 'user::create');
$routes->post('user/store', 'user::store');
$routes->get('user/edit/(:num)', 'User::edit/$1');
$routes->post('user/update/(:num)', 'User::update/$1');

$routes->get('user/delete/(:num)', 'user::delete/$1');
$routes->get('user/profile', 'User::profile');


/// attachment
$routes->get('attachment', 'attachment::index', $user);  // Rute GET untuk melihat daftar lampiran, hanya bisa diakses oleh user.
$routes->get('attachment/create', 'attachment::create', $user);  // Rute GET untuk membuat lampiran baru, hanya bisa diakses oleh user.
$routes->post('attachment/store', 'attachment::store', $user);  // Rute POST untuk menyimpan lampiran baru.
$routes->get('attachment/edit/(:num)', 'attachment::edit/$1', $user);  // Rute GET untuk mengedit lampiran berdasarkan ID yang diteruskan.
$routes->post('attachment/update/(:num)', 'attachment::update/$1', $user);  // Rute POST untuk memperbarui lampiran berdasarkan ID yang diteruskan.
$routes->post('attachment/delete/(:num)', 'attachment::delete/$1', $user);  // Rute POST untuk menghapus lampiran berdasarkan ID yang diteruskan.



// groups
$routes->get('groups', 'Groups::index');
$routes->get('groups/create', 'Groups::create');
$routes->post('groups/store', 'Groups::store');
$routes->get('groups/edit/(:num)', 'Groups::edit/$1');
$routes->post('groups/update/(:num)', 'Groups::update/$1');
$routes->get('groups/delete/(:num)', 'Groups::delete/$1');
$routes->get('groups/detail/(:num)', 'Groups::detail/$1');
$routes->post('groups/addMember', 'Groups::addMember');
$routes->post('groups/deleteMember', 'Groups::deleteMember');



// member
$routes->get('/member', 'member::index');
$routes->get('/member/create', 'member::create');
$routes->post('/member/store', 'member::store');
$routes->get('/member/edit/(:num)', 'member::edit/$1');
$routes->post('/member/update/(:num)', 'member::update/$1');
$routes->get('/member/delete/(:num)', 'member::delete/$1');



// friendship
$routes->get('/friendship', 'Friendship::index', $user);  // Rute GET untuk melihat daftar pertemanan, hanya bisa diakses oleh user.
$routes->get('friendship/index', 'Friendship::index', $user);  // Rute GET untuk melihat daftar pertemanan, hanya bisa diakses oleh user.
$routes->post('friendship/add', 'Friendship::add', $user);  // Rute POST untuk menambah pertemanan.
$routes->get('friendship/accept/(:num)', 'Friendship::accept/$1', $user);  // Rute GET untuk menerima pertemanan berdasarkan ID yang diteruskan.
$routes->get('friendship/decline/(:num)', 'Friendship::decline/$1', $user);  // Rute GET untuk menolak pertemanan berdasarkan ID yang diteruskan.
$routes->get('friendship/delete/(:num)', 'Friendship::delete/$1', $user);  // Rute GET untuk menghapus pertemanan berdasarkan ID yang diteruskan.
