<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Dashboard Routes
$routes->get('/Dashboard', 'Home::index');
$routes->get('/Dashboard-month', 'Home::month');
$routes->get('/Dashboard-year', 'Home::year');

// Pembayaran routes
$routes->get('/Pembayaran', 'Pembayaran::index');
$routes->post('/pembayaran/pilih/(:num)', 'Pembayaran::pilih/$1');
$routes->post('/disc', 'Pembayaran::disc');
$routes->post('/bayar', 'Pembayaran::bayar');
$routes->get('/transaksi/hapus/(:num)', 'Pembayaran::hapus/$1');

// Management Makanan Routes
$routes->get('/ManagementMakanan', 'ManagementMakanan::index');
$routes->post('/menu/create', 'ManagementMakanan::create');
$routes->post('/menu/edit/(:num)', 'ManagementMakanan::edit/$1');
$routes->post('/menu/hapus/(:num)', 'ManagementMakanan::hapus/$1');

// Laporan
$routes->get('/Laporan', 'Laporan::index');
$routes->post('/Laporan', 'Laporan::filter');
$routes->post('/Laporan/cetak', 'Laporan::cetak');
