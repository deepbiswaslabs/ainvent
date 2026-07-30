# AInvent

[![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?logo=laravel&logoColor=white)](https://laravel.com/)
[![MySQL](https://img.shields.io/badge/MySQL-8-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)
[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)
[![GitHub](https://img.shields.io/badge/GitHub-deepcoder94%2Fainvent-181717?logo=github)](https://github.com/deepcoder94/ainvent)

**Inventory & distribution management system** for distributors — products, customers, beats, invoices, payments, shipments, returns, sales, and profit tracking.

---

## Table of contents

- [About](#about)
- [Features](#features)
- [Tech stack](#tech-stack)
- [Getting started](#getting-started)
- [Usage](#usage)
- [Project structure](#project-structure)
- [Routes](#routes)
- [Contributing](#contributing)
- [License](#license)
- [Author](#author)

---

## About

AInvent is a Laravel web application built for distributor / wholesale workflows. It covers stock, invoicing (including request → approve → print), customer payments, beat-based routing, shipments, and returns — with CSV import/export and PDF generation.

Ideal as a portfolio piece demonstrating full-stack Laravel: Blade UI, Eloquent models, DomPDF, and feature-oriented routing.

---

## Features

| Area | Capabilities |
| --- | --- |
| **Dashboard** | Overview of business activity |
| **Sales & profit** | Sales list/search; profit list & export |
| **Invoicing** | Invoice requests (create, edit, approve, preview); invoice list; PDF print |
| **Inventory** | Stock listing, adjustments, history |
| **Catalog** | Products with measurements & max qty |
| **Distribution** | Distributor settings, beats, customers |
| **Payments** | Customer/invoice payments & payment history |
| **Logistics** | Shipment summary; returns management |
| **Data** | CSV import/export for products, customers, inventory |

---

## Tech stack

| Layer | Technology |
| --- | --- |
| Backend | PHP 8.2+, Laravel 11 |
| Frontend | Blade, Bootstrap, Vite, Tailwind CSS |
| Database | MySQL |
| PDF | barryvdh/laravel-dompdf |
| Testing | Pest |

---

## Getting started

### Prerequisites

- PHP ^8.2
- Composer
- Node.js & npm
- MySQL

### Installation

```bash
# Clone the repository
git clone https://github.com/deepcoder94/ainvent.git
cd ainvent

# Install PHP dependencies
composer install

# Environment
cp .env.example .env
php artisan key:generate

# Configure DB_* in .env, then:
php artisan migrate

# Frontend
npm install
npm run build
```

### Run locally

```bash
php artisan serve
```

Or run server, queue, and Vite together:

```bash
composer run dev
```

App URL (default): [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## Usage

1. Open `/` or `/dashboard` for the home screen.
2. Use the sidebar to navigate features (sales, invoices, inventory, customers, payments, etc.).
3. Create invoice requests via **Generate Invoice Request**, approve from **Invoice Requests**, then print from **Invoice List**.
4. Export/import catalog and inventory data from the respective list screens (CSV).

Named routes follow a feature prefix pattern, e.g. `route('customer.list')`, `route('invoice.request.create')`. All HTTP routes live in [`routes/web.php`](routes/web.php).

---

## Project structure

```text
ainvent/
├── app/
│   ├── Http/Controllers/     # Feature controllers
│   ├── Models/               # Eloquent models
│   ├── Providers/
│   └── helpers.php
├── bootstrap/
├── config/                   # Incl. dompdf
├── database/                 # Migrations, factories, seeders
├── public/                   # Web root & static assets
├── resources/
│   ├── js/                   # Vite entry
│   └── views/
│       ├── components/       # layout, sidebar, header, footer
│       └── pages/            # Feature Blade views
├── routes/
│   ├── web.php               # Application routes
│   └── console.php
├── storage/
└── tests/
```

### Controllers

| Controller | Responsibility |
| --- | --- |
| `DashboardController` | Home / dashboard |
| `SalesController` | Sales listing & search |
| `ProfitController` | Profit listing & export |
| `MeasurementController` | Measurement CRUD |
| `DistributorController` | Distributor settings |
| `BeatController` | Beat (route/area) CRUD |
| `CustomerController` | Customer CRUD & search |
| `ProductController` | Products, measurements, stock qty |
| `InventoryController` | Inventory listing & store |
| `InventoryHistoryController` | Inventory history |
| `ShipmentController` | Shipments |
| `PaymentController` | Payments |
| `PaymentHistoryController` | Payment history |
| `ReturnController` | Returns |
| `ExportController` / `ImportController` | CSV export / import |
| `InvoiceListController` | Invoice list, search, PDF |
| `GenerateInvoiceController` | Create invoices |
| `InvoiceRequestController` | Invoice requests |
| `BulkUploadController` | Bulk upload |

### Models

`Beat` · `Customer` · `CustomerPayment` · `Distributor` · `Inventory` · `InventoryHistory` · `Invoice` · `InvoiceProduct` · `InvoiceProfit` · `InvoiceRequest` · `InvoiceRequestProduct` · `Measurement` · `MeasurementType` · `PaymentHistory` · `Product` · `ProductMeasurement` · `Shipment` · `User`

### Views

Feature views under `resources/views/pages/`: `dashboard`, `sales`, `profit`, `beats`, `customers`, `products`, `inventory`, `inventory-history`, `shipments`, `payments`, `payment-history`, `returns`, `invoice`, `invoice-requests`, `distributor`, `pdf-formats`.

---

## Routes

Source of truth: [`routes/web.php`](routes/web.php).

<details>
<summary><strong>Utility & dashboard</strong></summary>

| Method | URI | Name |
| --- | --- | --- |
| GET | `/clear-config` | — |
| GET | `/` | `index` |
| GET | `/dashboard` | `dashboard` |

</details>

<details>
<summary><strong>Sales & profit</strong> (<code>sales.*</code>, <code>profit.*</code>)</summary>

| Method | URI | Name |
| --- | --- | --- |
| GET | `/sales/list` | `sales.list` |
| GET | `/sales/search` | `sales.search` |
| GET | `/profit/list` | `profit.list` |
| GET | `/profit/export` | `profit.export` |

</details>

<details>
<summary><strong>Measurements & distributor</strong></summary>

| Method | URI | Name |
| --- | --- | --- |
| POST | `/measurement/create` | `measurement.create` |
| GET | `/measurement/view/{id}` | `measurement.view` |
| POST | `/measurement/edit/{id}` | `measurement.update` |
| POST | `/measurement/delete/{id}` | `measurement.delete` |
| GET | `/distributor/list` | `distributor.index` |
| POST | `/distributor/update` | `distributor.update` |

</details>

<details>
<summary><strong>Beats</strong> (<code>beats.*</code>)</summary>

| Method | URI | Name |
| --- | --- | --- |
| GET | `/beats/list` | `beats.list` |
| POST | `/beats/store` | `beats.store` |
| GET | `/beats/view/{id}` | `beats.view` |
| POST | `/beats/edit/{id}` | `beats.edit` |
| POST | `/beats/delete/{id}` | `beats.delete` |
| GET | `/beats/{id}/customers` | `beats.customers` |

</details>

<details>
<summary><strong>Customers</strong> (<code>customer.*</code>)</summary>

| Method | URI | Name |
| --- | --- | --- |
| GET | `/customer/list` | `customer.list` |
| GET | `/customer/view/{id}` | `customer.view` |
| POST | `/customer/store` | `customer.store` |
| POST | `/customer/edit/{id}` | `customer.edit` |
| POST | `/customer/delete/{id}` | `customer.delete` |
| GET | `/customer/search` | `customer.search` |

</details>

<details>
<summary><strong>Products</strong> (<code>product.*</code>)</summary>

| Method | URI | Name |
| --- | --- | --- |
| GET | `/products/list` | `product.list` |
| POST | `/products/store` | `product.store` |
| GET | `/products/view/{id}` | `product.view` |
| POST | `/products/delete/{id}` | `product.delete` |
| POST | `/products/edit/{id}` | `product.edit` |
| GET | `/products/{id}/measurements` | `product.measurements` |
| GET | `/products/{id}/{typeId}/max_qty` | `product.max_qty` |

</details>

<details>
<summary><strong>Inventory & shipments</strong></summary>

| Method | URI | Name |
| --- | --- | --- |
| GET | `/inventory/list` | `inventory.list` |
| POST | `/inventory/store` | `inventory.store` |
| GET | `/inventory/history/list` | `inventory.history.list` |
| GET | `/inventory/history/listWithPaginate` | `inventory.history.listWithPaginate` |
| GET | `/shipment/list` | `shipment.list` |
| POST | `/shipment/store` | `shipment.store` |

</details>

<details>
<summary><strong>Payments</strong> (<code>payment.*</code>)</summary>

| Method | URI | Name |
| --- | --- | --- |
| GET | `/payment/list` | `payment.list` |
| GET | `/payment/view/{type}/{id}` | `payment.view` |
| POST | `/payment/edit/{id}` | `payment.edit` |
| GET | `/payment/history/list` | `payment.history.list` |
| GET | `/payment/history/view/{id}` | `payment.history.view` |
| GET | `/payment/history/search/{id}` | `payment.history.search` |

</details>

<details>
<summary><strong>Returns</strong> (<code>return.*</code>)</summary>

| Method | URI | Name |
| --- | --- | --- |
| GET | `/return/list` | `return.list` |
| GET | `/return/view/{id}/{index}` | `return.view` |
| POST | `/return/store` | `return.store` |

</details>

<details>
<summary><strong>Export / import</strong></summary>

| Method | URI | Name |
| --- | --- | --- |
| GET | `/export/product` | `export.product` |
| GET | `/export/customer` | `export.customer` |
| GET | `/export/inventory` | `export.inventory` |
| GET | `/export/csv/{file}` | `export.csv` |
| POST | `/export/product` | `import.product` |
| POST | `/export/customer` | `import.customer` |
| POST | `/export/inventory` | `import.inventory` |

Import routes share the `/export/...` URI prefix; they differ by HTTP method (`POST`).

</details>

<details>
<summary><strong>Invoices</strong> (<code>invoice.*</code>)</summary>

| Method | URI | Name |
| --- | --- | --- |
| GET | `/invoice/list` | `invoice.list` |
| POST | `/invoice/list` | `invoice.print` |
| GET | `/invoice/list/search` | `invoice.search` |
| GET | `/invoice/list/view/{id}` | `invoice.view` |
| GET | `/invoice/list/view/{id}/products/{index}` | `invoice.products` |
| GET | `/invoice/create` | `invoice.create.list` |
| POST | `/invoice/create` | `invoice.create` |
| GET | `/invoice/create/{id}/single_product` | `invoice.create.single_product` |
| GET | `/invoice/request/list` | `invoice.request.list` |
| GET | `/invoice/request/create` | `invoice.request.create` |
| POST | `/invoice/request/store` | `invoice.request.store` |
| GET | `/invoice/request/{id}/edit` | `invoice.request.edit` |
| POST | `/invoice/request/{id}/update` | `invoice.request.update` |
| POST | `/invoice/request/delete/{id}` | `invoice.request.delete` |
| POST | `/invoice/request/approve` | `invoice.request.approve` |
| POST | `/invoice/request/preview` | `invoice.request.preview` |

</details>

---

## Contributing

Contributions are welcome.

1. Fork the repo
2. Create a feature branch (`git checkout -b feature/your-feature`)
3. Commit your changes
4. Push and open a Pull Request against `main`

Please keep PRs focused and match existing code style (Laravel Pint / project conventions).

---

## License

This project is licensed under the [MIT License](LICENSE).

---

## Author

**Deep** · [github.com/deepcoder94](https://github.com/deepcoder94)

Repository: [github.com/deepcoder94/ainvent](https://github.com/deepcoder94/ainvent)

If this project is useful, consider starring the repo on GitHub.
