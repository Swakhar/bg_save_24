<?php return array (
  'acl' => 
  array (
    0 => 
    array (
      'key' => 'dashboard',
      'name' => 'admin::app.acl.dashboard',
      'route' => 'admin.dashboard.index',
      'sort' => 1,
    ),
    1 => 
    array (
      'key' => 'sales',
      'name' => 'admin::app.acl.sales',
      'route' => 'admin.sales.orders.index',
      'sort' => 2,
    ),
    2 => 
    array (
      'key' => 'sales.orders',
      'name' => 'admin::app.acl.orders',
      'route' => 'admin.sales.orders.index',
      'sort' => 1,
    ),
    3 => 
    array (
      'key' => 'sales.invoices',
      'name' => 'admin::app.acl.invoices',
      'route' => 'admin.sales.invoices.index',
      'sort' => 2,
    ),
    4 => 
    array (
      'key' => 'sales.shipments',
      'name' => 'admin::app.acl.shipments',
      'route' => 'admin.sales.shipments.index',
      'sort' => 3,
    ),
    5 => 
    array (
      'key' => 'catalog',
      'name' => 'admin::app.acl.catalog',
      'route' => 'admin.catalog.index',
      'sort' => 3,
    ),
    6 => 
    array (
      'key' => 'catalog.products',
      'name' => 'admin::app.acl.products',
      'route' => 'admin.catalog.products.index',
      'sort' => 1,
    ),
    7 => 
    array (
      'key' => 'catalog.products.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.catalog.products.create',
      'sort' => 1,
    ),
    8 => 
    array (
      'key' => 'catalog.products.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.catalog.products.edit',
      'sort' => 2,
    ),
    9 => 
    array (
      'key' => 'catalog.products.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.catalog.products.delete',
      'sort' => 3,
    ),
    10 => 
    array (
      'key' => 'catalog.categories',
      'name' => 'admin::app.acl.categories',
      'route' => 'admin.catalog.categories.index',
      'sort' => 2,
    ),
    11 => 
    array (
      'key' => 'catalog.categories.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.catalog.categories.create',
      'sort' => 1,
    ),
    12 => 
    array (
      'key' => 'catalog.categories.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.catalog.categories.edit',
      'sort' => 2,
    ),
    13 => 
    array (
      'key' => 'catalog.categories.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.catalog.categories.delete',
      'sort' => 3,
    ),
    14 => 
    array (
      'key' => 'catalog.attributes',
      'name' => 'admin::app.acl.attributes',
      'route' => 'admin.catalog.attributes.index',
      'sort' => 3,
    ),
    15 => 
    array (
      'key' => 'catalog.attributes.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.catalog.attributes.create',
      'sort' => 1,
    ),
    16 => 
    array (
      'key' => 'catalog.attributes.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.catalog.attributes.edit',
      'sort' => 2,
    ),
    17 => 
    array (
      'key' => 'catalog.attributes.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.catalog.attributes.delete',
      'sort' => 3,
    ),
    18 => 
    array (
      'key' => 'catalog.families',
      'name' => 'admin::app.acl.attribute-families',
      'route' => 'admin.catalog.families.index',
      'sort' => 4,
    ),
    19 => 
    array (
      'key' => 'catalog.families.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.catalog.families.create',
      'sort' => 1,
    ),
    20 => 
    array (
      'key' => 'catalog.families.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.catalog.families.edit',
      'sort' => 2,
    ),
    21 => 
    array (
      'key' => 'catalog.families.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.catalog.families.delete',
      'sort' => 3,
    ),
    22 => 
    array (
      'key' => 'customers',
      'name' => 'admin::app.acl.customers',
      'route' => 'admin.customer.index',
      'sort' => 4,
    ),
    23 => 
    array (
      'key' => 'customers.customers',
      'name' => 'admin::app.acl.customers',
      'route' => 'admin.customer.index',
      'sort' => 1,
    ),
    24 => 
    array (
      'key' => 'customers.customers.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.customer.create',
      'sort' => 1,
    ),
    25 => 
    array (
      'key' => 'customers.customers.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.customer.edit',
      'sort' => 2,
    ),
    26 => 
    array (
      'key' => 'customers.customers.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.customer.delete',
      'sort' => 3,
    ),
    27 => 
    array (
      'key' => 'customers.groups',
      'name' => 'admin::app.acl.groups',
      'route' => 'admin.groups.index',
      'sort' => 2,
    ),
    28 => 
    array (
      'key' => 'customers.groups.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.groups.create',
      'sort' => 1,
    ),
    29 => 
    array (
      'key' => 'customers.groups.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.groups.edit',
      'sort' => 2,
    ),
    30 => 
    array (
      'key' => 'customers.groups.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.groups.delete',
      'sort' => 3,
    ),
    31 => 
    array (
      'key' => 'customers.reviews',
      'name' => 'admin::app.acl.reviews',
      'route' => 'admin.customer.review.index',
      'sort' => 3,
    ),
    32 => 
    array (
      'key' => 'customers.reviews.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.customer.review.edit',
      'sort' => 1,
    ),
    33 => 
    array (
      'key' => 'customers.reviews.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.customer.review.delete',
      'sort' => 2,
    ),
    34 => 
    array (
      'key' => 'configuration',
      'name' => 'admin::app.acl.configure',
      'route' => 'admin.configuration.index',
      'sort' => 5,
    ),
    35 => 
    array (
      'key' => 'settings',
      'name' => 'admin::app.acl.settings',
      'route' => 'admin.users.index',
      'sort' => 6,
    ),
    36 => 
    array (
      'key' => 'settings.locales',
      'name' => 'admin::app.acl.locales',
      'route' => 'admin.locales.index',
      'sort' => 1,
    ),
    37 => 
    array (
      'key' => 'settings.locales.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.locales.create',
      'sort' => 1,
    ),
    38 => 
    array (
      'key' => 'settings.locales.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.locales.edit',
      'sort' => 2,
    ),
    39 => 
    array (
      'key' => 'settings.locales.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.locales.delete',
      'sort' => 3,
    ),
    40 => 
    array (
      'key' => 'settings.currencies',
      'name' => 'admin::app.acl.currencies',
      'route' => 'admin.currencies.index',
      'sort' => 2,
    ),
    41 => 
    array (
      'key' => 'settings.currencies.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.currencies.create',
      'sort' => 1,
    ),
    42 => 
    array (
      'key' => 'settings.currencies.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.currencies.edit',
      'sort' => 2,
    ),
    43 => 
    array (
      'key' => 'settings.currencies.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.currencies.delete',
      'sort' => 3,
    ),
    44 => 
    array (
      'key' => 'settings.exchange_rates',
      'name' => 'admin::app.acl.exchange-rates',
      'route' => 'admin.exchange_rates.index',
      'sort' => 3,
    ),
    45 => 
    array (
      'key' => 'settings.exchange_rates.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.exchange_rates.create',
      'sort' => 1,
    ),
    46 => 
    array (
      'key' => 'settings.exchange_rates.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.exchange_rates.edit',
      'sort' => 2,
    ),
    47 => 
    array (
      'key' => 'settings.exchange_rates.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.exchange_rates.delete',
      'sort' => 3,
    ),
    48 => 
    array (
      'key' => 'settings.inventory_sources',
      'name' => 'admin::app.acl.inventory-sources',
      'route' => 'admin.inventory_sources.index',
      'sort' => 4,
    ),
    49 => 
    array (
      'key' => 'settings.inventory_sources.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.inventory_sources.create',
      'sort' => 1,
    ),
    50 => 
    array (
      'key' => 'settings.inventory_sources.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.inventory_sources.edit',
      'sort' => 2,
    ),
    51 => 
    array (
      'key' => 'settings.inventory_sources.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.inventory_sources.delete',
      'sort' => 3,
    ),
    52 => 
    array (
      'key' => 'settings.channels',
      'name' => 'admin::app.acl.channels',
      'route' => 'admin.channels.index',
      'sort' => 5,
    ),
    53 => 
    array (
      'key' => 'settings.channels.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.channels.create',
      'sort' => 1,
    ),
    54 => 
    array (
      'key' => 'settings.channels.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.channels.edit',
      'sort' => 2,
    ),
    55 => 
    array (
      'key' => 'settings.channels.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.channels.delete',
      'sort' => 3,
    ),
    56 => 
    array (
      'key' => 'settings.users',
      'name' => 'admin::app.acl.users',
      'route' => 'admin.users.index',
      'sort' => 6,
    ),
    57 => 
    array (
      'key' => 'settings.users.users',
      'name' => 'admin::app.acl.users',
      'route' => 'admin.users.index',
      'sort' => 1,
    ),
    58 => 
    array (
      'key' => 'settings.users.users.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.users.create',
      'sort' => 1,
    ),
    59 => 
    array (
      'key' => 'settings.users.users.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.users.edit',
      'sort' => 2,
    ),
    60 => 
    array (
      'key' => 'settings.users.users.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.users.delete',
      'sort' => 3,
    ),
    61 => 
    array (
      'key' => 'settings.users.roles',
      'name' => 'admin::app.acl.roles',
      'route' => 'admin.roles.index',
      'sort' => 2,
    ),
    62 => 
    array (
      'key' => 'settings.users.roles.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.roles.create',
      'sort' => 1,
    ),
    63 => 
    array (
      'key' => 'settings.users.roles.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.roles.edit',
      'sort' => 2,
    ),
    64 => 
    array (
      'key' => 'settings.users.roles.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.roles.delete',
      'sort' => 3,
    ),
    65 => 
    array (
      'key' => 'settings.sliders',
      'name' => 'admin::app.acl.sliders',
      'route' => 'admin.sliders.index',
      'sort' => 7,
    ),
    66 => 
    array (
      'key' => 'settings.sliders.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.sliders.create',
      'sort' => 1,
    ),
    67 => 
    array (
      'key' => 'settings.sliders.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.sliders.edit',
      'sort' => 2,
    ),
    68 => 
    array (
      'key' => 'settings.sliders.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.sliders.delete',
      'sort' => 3,
    ),
    69 => 
    array (
      'key' => 'settings.taxes',
      'name' => 'admin::app.acl.taxes',
      'route' => 'admin.tax-categories.index',
      'sort' => 8,
    ),
    70 => 
    array (
      'key' => 'settings.taxes.tax-categories',
      'name' => 'admin::app.acl.tax-categories',
      'route' => 'admin.tax-categories.index',
      'sort' => 1,
    ),
    71 => 
    array (
      'key' => 'settings.taxes.tax-categories.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.tax-categories.create',
      'sort' => 1,
    ),
    72 => 
    array (
      'key' => 'settings.taxes.tax-categories.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.tax-categories.edit',
      'sort' => 2,
    ),
    73 => 
    array (
      'key' => 'settings.taxes.tax-categories.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.tax-categories.delete',
      'sort' => 3,
    ),
    74 => 
    array (
      'key' => 'settings.taxes.tax-rates',
      'name' => 'admin::app.acl.tax-rates',
      'route' => 'admin.tax-rates.index',
      'sort' => 2,
    ),
    75 => 
    array (
      'key' => 'settings.taxes.tax-rates.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.tax-rates.create',
      'sort' => 1,
    ),
    76 => 
    array (
      'key' => 'settings.taxes.tax-rates.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.tax-rates.edit',
      'sort' => 2,
    ),
    77 => 
    array (
      'key' => 'settings.taxes.tax-rates.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.tax-rates.delete',
      'sort' => 3,
    ),
    78 => 
    array (
      'key' => 'promotions',
      'name' => 'admin::app.acl.promotions',
      'route' => 'admin.cart-rules.index',
      'sort' => 7,
    ),
    79 => 
    array (
      'key' => 'promotions.cart-rules',
      'name' => 'admin::app.acl.cart-rules',
      'route' => 'admin.cart-rules.index',
      'sort' => 1,
    ),
    80 => 
    array (
      'key' => 'promotions.cart-rules.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.cart-rules.create',
      'sort' => 1,
    ),
    81 => 
    array (
      'key' => 'promotions.cart-rules.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.cart-rules.edit',
      'sort' => 2,
    ),
    82 => 
    array (
      'key' => 'promotions.cart-rules.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.cart-rules.delete',
      'sort' => 3,
    ),
  ),
  'app' => 
  array (
    'name' => 'Bagisto_',
    'env' => 'local',
    'debug' => true,
    'url' => 'https://127.0.0.1:8000',
    'timezone' => 'Africa/Abidjan',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'default_country' => NULL,
    'currency' => 'USD',
    'channel' => 'default',
    'key' => 'base64:9HHrFF4yilD6A1WlH+6NayBTwb/4IozOGYUmfufD6IU=',
    'cipher' => 'AES-256-CBC',
    'editor' => 'vscode',
    'version' => '1.1.2',
    'debug_blacklist' => 
    array (
      '_ENV' => 
      array (
        0 => 'APP_KEY',
        1 => 'DB_PASSWORD',
      ),
      '_SERVER' => 
      array (
        0 => 'APP_KEY',
        1 => 'DB_PASSWORD',
      ),
      '_POST' => 
      array (
        0 => 'password',
      ),
    ),
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'Astrotomic\\Translatable\\TranslatableServiceProvider',
      23 => 'App\\Providers\\AppServiceProvider',
      24 => 'App\\Providers\\AuthServiceProvider',
      25 => 'App\\Providers\\EventServiceProvider',
      26 => 'App\\Providers\\RouteServiceProvider',
      27 => 'Intervention\\Image\\ImageServiceProvider',
      28 => 'Maatwebsite\\Excel\\ExcelServiceProvider',
      29 => 'Barryvdh\\Debugbar\\ServiceProvider',
      30 => 'Prettus\\Repository\\Providers\\RepositoryServiceProvider',
      31 => 'Konekt\\Concord\\ConcordServiceProvider',
      32 => 'Flynsarmy\\DbBladeCompiler\\DbBladeCompilerServiceProvider',
      33 => 'Barryvdh\\DomPDF\\ServiceProvider',
      34 => 'Tymon\\JWTAuth\\Providers\\LaravelServiceProvider',
      35 => 'Webkul\\Theme\\Providers\\ThemeServiceProvider',
      36 => 'Webkul\\User\\Providers\\UserServiceProvider',
      37 => 'Webkul\\Admin\\Providers\\AdminServiceProvider',
      38 => 'Webkul\\Ui\\Providers\\UiServiceProvider',
      39 => 'Webkul\\Category\\Providers\\CategoryServiceProvider',
      40 => 'Webkul\\Attribute\\Providers\\AttributeServiceProvider',
      41 => 'Webkul\\Core\\Providers\\CoreServiceProvider',
      42 => 'Webkul\\Shop\\Providers\\ShopServiceProvider',
      43 => 'Webkul\\Customer\\Providers\\CustomerServiceProvider',
      44 => 'Webkul\\Inventory\\Providers\\InventoryServiceProvider',
      45 => 'Webkul\\Product\\Providers\\ProductServiceProvider',
      46 => 'Webkul\\Checkout\\Providers\\CheckoutServiceProvider',
      47 => 'Webkul\\Shipping\\Providers\\ShippingServiceProvider',
      48 => 'Webkul\\Payment\\Providers\\PaymentServiceProvider',
      49 => 'Webkul\\Paypal\\Providers\\PaypalServiceProvider',
      50 => 'Webkul\\Sales\\Providers\\SalesServiceProvider',
      51 => 'Webkul\\Tax\\Providers\\TaxServiceProvider',
      52 => 'Webkul\\API\\Providers\\APIServiceProvider',
      53 => 'Webkul\\CatalogRule\\Providers\\CatalogRuleServiceProvider',
      54 => 'Webkul\\CartRule\\Providers\\CartRuleServiceProvider',
      55 => 'Webkul\\Rule\\Providers\\RuleServiceProvider',
      56 => 'Webkul\\CMS\\Providers\\CMSServiceProvider',
      57 => 'Webkul\\Velocity\\Providers\\VelocityServiceProvider',
      58 => 'Webkul\\BookingProduct\\Providers\\BookingProductServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Datagrid' => 'Webkul\\Ui\\DataGrid\\Facades\\DataGrid',
      'ProductGrid' => 'Webkul\\Ui\\DataGrid\\Facades\\ProductGrid',
      'Image' => 'Intervention\\Image\\Facades\\Image',
      'Cart' => 'Webkul\\Checkout\\Facades\\Cart',
      'Core' => 'Webkul\\Core\\Facades\\Core',
      'DbView' => 'Flynsarmy\\DbBladeCompiler\\Facades\\DbView',
      'PDF' => 'Barryvdh\\DomPDF\\Facade',
      'Excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
      'Concord' => 'Konekt\\Concord\\Facades\\Concord',
      'Helper' => 'Konekt\\Concord\\Facades\\Helper',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'admins',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'admins',
      ),
      'api' => 
      array (
        'driver' => 'jwt',
        'provider' => 'customers',
      ),
      'customer' => 
      array (
        'driver' => 'session',
        'provider' => 'customers',
      ),
      'admin' => 
      array (
        'driver' => 'session',
        'provider' => 'admins',
      ),
      'admin-api' => 
      array (
        'driver' => 'token',
        'provider' => 'admins',
      ),
    ),
    'providers' => 
    array (
      'customers' => 
      array (
        'driver' => 'eloquent',
        'model' => 'Webkul\\Customer\\Models\\Customer',
      ),
      'admins' => 
      array (
        'driver' => 'eloquent',
        'model' => 'Webkul\\User\\Models\\Admin',
      ),
    ),
    'passwords' => 
    array (
      'admins' => 
      array (
        'provider' => 'admins',
        'table' => 'admin_password_resets',
        'expire' => 60,
      ),
      'customers' => 
      array (
        'provider' => 'customers',
        'table' => 'customer_password_resets',
        'expire' => 60,
      ),
    ),
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '',
        'secret' => '',
        'app_id' => '',
        'options' => 
        array (
          'cluster' => 'mt1',
          'encrypted' => true,
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => 'E:\\Xampp\\htdocs\\bg_save_24\\storage\\framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'client' => 'predis',
        'clusters' => 
        array (
          'default' => 
          array (
            0 => 
            array (
              'host' => '127.0.0.1',
              'password' => NULL,
              'port' => '6379',
              'database' => 0,
            ),
          ),
        ),
      ),
    ),
    'prefix' => 'bagisto_cache',
  ),
  'carriers' => 
  array (
    'flatrate' => 
    array (
      'code' => 'flatrate',
      'title' => 'Flat Rate',
      'description' => 'Flat Rate Shipping',
      'active' => true,
      'default_rate' => '10',
      'type' => 'per_unit',
      'class' => 'Webkul\\Shipping\\Carriers\\FlatRate',
    ),
    'free' => 
    array (
      'code' => 'free',
      'title' => 'Free Shipping',
      'description' => 'Free Shipping',
      'active' => true,
      'default_rate' => '0',
      'class' => 'Webkul\\Shipping\\Carriers\\Free',
    ),
  ),
  'concord' => 
  array (
    'modules' => 
    array (
      0 => 'Webkul\\Attribute\\Providers\\ModuleServiceProvider',
      1 => 'Webkul\\BookingProduct\\Providers\\ModuleServiceProvider',
      2 => 'Webkul\\Category\\Providers\\ModuleServiceProvider',
      3 => 'Webkul\\Checkout\\Providers\\ModuleServiceProvider',
      4 => 'Webkul\\Core\\Providers\\ModuleServiceProvider',
      5 => 'Webkul\\Customer\\Providers\\ModuleServiceProvider',
      6 => 'Webkul\\Inventory\\Providers\\ModuleServiceProvider',
      7 => 'Webkul\\Product\\Providers\\ModuleServiceProvider',
      8 => 'Webkul\\Sales\\Providers\\ModuleServiceProvider',
      9 => 'Webkul\\Tax\\Providers\\ModuleServiceProvider',
      10 => 'Webkul\\User\\Providers\\ModuleServiceProvider',
      11 => 'Webkul\\CatalogRule\\Providers\\ModuleServiceProvider',
      12 => 'Webkul\\CartRule\\Providers\\ModuleServiceProvider',
      13 => 'Webkul\\CMS\\Providers\\ModuleServiceProvider',
      14 => 'Webkul\\Velocity\\Providers\\ModuleServiceProvider',
    ),
  ),
  'core' => 
  array (
    0 => 
    array (
      'key' => 'sales.orderSettings',
      'name' => 'admin::app.admin.system.order-settings',
      'sort' => 3,
    ),
    1 => 
    array (
      'key' => 'sales.orderSettings.order_number',
      'name' => 'admin::app.admin.system.orderNumber',
      'sort' => 0,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'order_number_prefix',
          'title' => 'admin::app.admin.system.order-number-prefix',
          'type' => 'text',
          'validation' => false,
          'channel_based' => true,
          'locale_based' => true,
        ),
        1 => 
        array (
          'name' => 'order_number_length',
          'title' => 'admin::app.admin.system.order-number-length',
          'type' => 'text',
          'validation' => 'numeric',
          'channel_based' => true,
          'locale_based' => true,
        ),
        2 => 
        array (
          'name' => 'order_number_suffix',
          'title' => 'admin::app.admin.system.order-number-suffix',
          'type' => 'text',
          'validation' => false,
          'channel_based' => true,
          'locale_based' => true,
        ),
      ),
    ),
    2 => 
    array (
      'key' => 'sales.orderSettings.invoice_slip_design',
      'name' => 'admin::app.admin.system.invoice-slip-design',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'logo',
          'title' => 'admin::app.admin.system.logo',
          'type' => 'image',
          'validation' => 'mimes:jpeg,bmp,png,jpg',
          'channel_based' => true,
        ),
        1 => 
        array (
          'name' => 'address',
          'title' => 'admin::app.admin.system.address',
          'type' => 'textarea',
          'channel_based' => true,
        ),
      ),
    ),
    3 => 
    array (
      'key' => 'sales',
      'name' => 'admin::app.admin.system.sales',
      'sort' => 1,
    ),
    4 => 
    array (
      'key' => 'sales.paymentmethods',
      'name' => 'admin::app.admin.system.payment-methods',
      'sort' => 2,
    ),
    5 => 
    array (
      'key' => 'sales.paymentmethods.cashondelivery',
      'name' => 'admin::app.admin.system.cash-on-delivery',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'title',
          'title' => 'admin::app.admin.system.title',
          'type' => 'text',
          'validation' => 'required',
          'channel_based' => false,
          'locale_based' => true,
        ),
        1 => 
        array (
          'name' => 'description',
          'title' => 'admin::app.admin.system.description',
          'type' => 'textarea',
          'channel_based' => false,
          'locale_based' => true,
        ),
        2 => 
        array (
          'name' => 'active',
          'title' => 'admin::app.admin.system.status',
          'type' => 'boolean',
          'validation' => 'required',
          'channel_based' => false,
          'locale_based' => true,
        ),
        3 => 
        array (
          'name' => 'sort',
          'title' => 'admin::app.admin.system.sort_order',
          'type' => 'select',
          'options' => 
          array (
            0 => 
            array (
              'title' => '1',
              'value' => 1,
            ),
            1 => 
            array (
              'title' => '2',
              'value' => 2,
            ),
            2 => 
            array (
              'title' => '3',
              'value' => 3,
            ),
            3 => 
            array (
              'title' => '4',
              'value' => 4,
            ),
          ),
        ),
      ),
    ),
    6 => 
    array (
      'key' => 'sales.paymentmethods.moneytransfer',
      'name' => 'admin::app.admin.system.money-transfer',
      'sort' => 2,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'title',
          'title' => 'admin::app.admin.system.title',
          'type' => 'text',
          'validation' => 'required',
          'channel_based' => false,
          'locale_based' => true,
        ),
        1 => 
        array (
          'name' => 'description',
          'title' => 'admin::app.admin.system.description',
          'type' => 'textarea',
          'channel_based' => false,
          'locale_based' => true,
        ),
        2 => 
        array (
          'name' => 'active',
          'title' => 'admin::app.admin.system.status',
          'type' => 'boolean',
          'validation' => 'required',
          'channel_based' => false,
          'locale_based' => true,
        ),
        3 => 
        array (
          'name' => 'sort',
          'title' => 'admin::app.admin.system.sort_order',
          'type' => 'select',
          'options' => 
          array (
            0 => 
            array (
              'title' => '1',
              'value' => 1,
            ),
            1 => 
            array (
              'title' => '2',
              'value' => 2,
            ),
            2 => 
            array (
              'title' => '3',
              'value' => 3,
            ),
            3 => 
            array (
              'title' => '4',
              'value' => 4,
            ),
          ),
        ),
      ),
    ),
    7 => 
    array (
      'key' => 'sales.paymentmethods.paypal_standard',
      'name' => 'admin::app.admin.system.paypal-standard',
      'sort' => 3,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'title',
          'title' => 'admin::app.admin.system.title',
          'type' => 'text',
          'validation' => 'required',
          'channel_based' => false,
          'locale_based' => true,
        ),
        1 => 
        array (
          'name' => 'description',
          'title' => 'admin::app.admin.system.description',
          'type' => 'textarea',
          'channel_based' => false,
          'locale_based' => true,
        ),
        2 => 
        array (
          'name' => 'business_account',
          'title' => 'admin::app.admin.system.business-account',
          'type' => 'text',
          'validation' => 'required',
        ),
        3 => 
        array (
          'name' => 'active',
          'title' => 'admin::app.admin.system.status',
          'type' => 'boolean',
          'validation' => 'required',
          'channel_based' => false,
          'locale_based' => true,
        ),
        4 => 
        array (
          'name' => 'sandbox',
          'title' => 'admin::app.admin.system.sandbox',
          'type' => 'boolean',
          'validation' => 'required',
          'channel_based' => false,
          'locale_based' => true,
        ),
        5 => 
        array (
          'name' => 'sort',
          'title' => 'admin::app.admin.system.sort_order',
          'type' => 'select',
          'options' => 
          array (
            0 => 
            array (
              'title' => '1',
              'value' => 1,
            ),
            1 => 
            array (
              'title' => '2',
              'value' => 2,
            ),
            2 => 
            array (
              'title' => '3',
              'value' => 3,
            ),
            3 => 
            array (
              'title' => '4',
              'value' => 4,
            ),
          ),
        ),
      ),
    ),
    8 => 
    array (
      'key' => 'sales',
      'name' => 'admin::app.admin.system.sales',
      'sort' => 5,
    ),
    9 => 
    array (
      'key' => 'sales.carriers',
      'name' => 'admin::app.admin.system.shipping-methods',
      'sort' => 1,
    ),
    10 => 
    array (
      'key' => 'sales.carriers.free',
      'name' => 'admin::app.admin.system.free-shipping',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'title',
          'title' => 'admin::app.admin.system.title',
          'type' => 'text',
          'validation' => 'required',
          'channel_based' => false,
          'locale_based' => true,
        ),
        1 => 
        array (
          'name' => 'description',
          'title' => 'admin::app.admin.system.description',
          'type' => 'textarea',
          'channel_based' => false,
          'locale_based' => true,
        ),
        2 => 
        array (
          'name' => 'active',
          'title' => 'admin::app.admin.system.status',
          'type' => 'boolean',
          'validation' => 'required',
          'channel_based' => false,
          'locale_based' => true,
        ),
      ),
    ),
    11 => 
    array (
      'key' => 'sales.carriers.flatrate',
      'name' => 'admin::app.admin.system.flate-rate-shipping',
      'sort' => 2,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'title',
          'title' => 'admin::app.admin.system.title',
          'type' => 'text',
          'validation' => 'required',
          'channel_based' => true,
          'locale_based' => true,
        ),
        1 => 
        array (
          'name' => 'description',
          'title' => 'admin::app.admin.system.description',
          'type' => 'textarea',
          'channel_based' => true,
          'locale_based' => false,
        ),
        2 => 
        array (
          'name' => 'default_rate',
          'title' => 'admin::app.admin.system.rate',
          'type' => 'text',
          'validation' => 'required',
          'channel_based' => true,
          'locale_based' => false,
        ),
        3 => 
        array (
          'name' => 'type',
          'title' => 'admin::app.admin.system.type',
          'type' => 'select',
          'options' => 
          array (
            0 => 
            array (
              'title' => 'Per Unit',
              'value' => 'per_unit',
            ),
            1 => 
            array (
              'title' => 'Per Order',
              'value' => 'per_order',
            ),
          ),
          'validation' => 'required',
        ),
        4 => 
        array (
          'name' => 'active',
          'title' => 'admin::app.admin.system.status',
          'type' => 'boolean',
          'validation' => 'required',
          'channel_based' => false,
          'locale_based' => true,
        ),
      ),
    ),
    12 => 
    array (
      'key' => 'sales.shipping',
      'name' => 'admin::app.admin.system.shipping',
      'sort' => 0,
    ),
    13 => 
    array (
      'key' => 'sales.shipping.origin',
      'name' => 'admin::app.admin.system.origin',
      'sort' => 0,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'country',
          'title' => 'admin::app.admin.system.country',
          'type' => 'country',
          'validation' => 'required',
          'channel_based' => true,
          'locale_based' => true,
        ),
        1 => 
        array (
          'name' => 'state',
          'title' => 'admin::app.admin.system.state',
          'type' => 'state',
          'validation' => 'required',
          'channel_based' => true,
          'locale_based' => true,
        ),
        2 => 
        array (
          'name' => 'address1',
          'title' => 'admin::app.admin.system.street-address',
          'type' => 'text',
          'validation' => 'required',
          'channel_based' => true,
          'locale_based' => false,
        ),
        3 => 
        array (
          'name' => 'zipcode',
          'title' => 'admin::app.admin.system.zip',
          'type' => 'text',
          'validation' => 'required',
          'channel_based' => true,
          'locale_based' => false,
        ),
        4 => 
        array (
          'name' => 'city',
          'title' => 'admin::app.admin.system.city',
          'type' => 'text',
          'validation' => 'required',
          'channel_based' => true,
          'locale_based' => false,
        ),
      ),
    ),
    14 => 
    array (
      'key' => 'general',
      'name' => 'admin::app.admin.system.general',
      'sort' => 1,
    ),
    15 => 
    array (
      'key' => 'general.general',
      'name' => 'admin::app.admin.system.general',
      'sort' => 1,
    ),
    16 => 
    array (
      'key' => 'general.general.locale_options',
      'name' => 'admin::app.admin.system.locale-options',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'weight_unit',
          'title' => 'admin::app.admin.system.weight-unit',
          'type' => 'select',
          'options' => 
          array (
            0 => 
            array (
              'title' => 'lbs',
              'value' => 'lbs',
            ),
            1 => 
            array (
              'title' => 'kgs',
              'value' => 'kgs',
            ),
          ),
          'channel_based' => true,
        ),
      ),
    ),
    17 => 
    array (
      'key' => 'general.general.email_settings',
      'name' => 'admin::app.admin.system.email-settings',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'sender_name',
          'title' => 'admin::app.admin.system.email-sender-name',
          'type' => 'text',
          'validation' => 'required|max:50',
          'channel_based' => true,
        ),
        1 => 
        array (
          'name' => 'shop_email_from',
          'title' => 'admin::app.admin.system.shop-email-from',
          'type' => 'text',
          'validation' => 'required|email',
          'channel_based' => true,
        ),
        2 => 
        array (
          'name' => 'admin_name',
          'title' => 'admin::app.admin.system.admin-name',
          'type' => 'text',
          'validation' => 'required|max:50',
          'channel_based' => true,
        ),
        3 => 
        array (
          'name' => 'admin_email',
          'title' => 'admin::app.admin.system.admin-email',
          'type' => 'text',
          'validation' => 'required|email',
          'channel_based' => true,
        ),
      ),
    ),
    18 => 
    array (
      'key' => 'general.content',
      'name' => 'admin::app.admin.system.content',
      'sort' => 2,
    ),
    19 => 
    array (
      'key' => 'general.content.footer',
      'name' => 'admin::app.admin.system.footer',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'footer_content',
          'title' => 'admin::app.admin.system.footer-content',
          'type' => 'text',
          'channel_based' => true,
          'locale_based' => true,
        ),
        1 => 
        array (
          'name' => 'footer_toggle',
          'title' => 'admin::app.admin.system.footer-toggle',
          'type' => 'boolean',
          'locale_based' => true,
          'channel_based' => true,
        ),
      ),
    ),
    20 => 
    array (
      'key' => 'general.design',
      'name' => 'admin::app.admin.system.design',
      'sort' => 3,
    ),
    21 => 
    array (
      'key' => 'general.design.admin_logo',
      'name' => 'admin::app.admin.system.admin-logo',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'logo_image',
          'title' => 'admin::app.admin.system.logo-image',
          'type' => 'image',
          'channel_based' => true,
          'validation' => 'mimes:jpeg,bmp,png,jpg',
        ),
        1 => 
        array (
          'name' => 'favicon',
          'title' => 'admin::app.admin.system.favicon',
          'type' => 'image',
          'channel_based' => true,
          'validation' => 'mimes:jpeg,bmp,png,jpg',
        ),
      ),
    ),
    22 => 
    array (
      'key' => 'catalog',
      'name' => 'admin::app.admin.system.catalog',
      'sort' => 2,
    ),
    23 => 
    array (
      'key' => 'catalog.products',
      'name' => 'admin::app.admin.system.products',
      'sort' => 2,
    ),
    24 => 
    array (
      'key' => 'catalog.products.guest-checkout',
      'name' => 'admin::app.admin.system.guest-checkout',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'allow-guest-checkout',
          'title' => 'admin::app.admin.system.allow-guest-checkout',
          'type' => 'boolean',
        ),
      ),
    ),
    25 => 
    array (
      'key' => 'catalog.products.storefront',
      'name' => 'admin::app.admin.system.storefront',
      'sort' => 2,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'mode',
          'title' => 'admin::app.admin.system.default-list-mode',
          'type' => 'select',
          'options' => 
          array (
            0 => 
            array (
              'title' => 'admin::app.admin.system.grid',
              'value' => 'grid',
            ),
            1 => 
            array (
              'title' => 'admin::app.admin.system.list',
              'value' => 'list',
            ),
          ),
          'channel_based' => true,
        ),
        1 => 
        array (
          'name' => 'products_per_page',
          'title' => 'admin::app.admin.system.products-per-page',
          'type' => 'text',
          'info' => 'admin::app.admin.system.comma-seperated',
          'channel_based' => true,
        ),
        2 => 
        array (
          'name' => 'sort_by',
          'title' => 'admin::app.admin.system.sort-by',
          'type' => 'select',
          'options' => 
          array (
            0 => 
            array (
              'title' => 'admin::app.admin.system.from-z-a',
              'value' => 'name-desc',
            ),
            1 => 
            array (
              'title' => 'admin::app.admin.system.from-a-z',
              'value' => 'name-asc',
            ),
            2 => 
            array (
              'title' => 'admin::app.admin.system.newest-first',
              'value' => 'created_at-desc',
            ),
            3 => 
            array (
              'title' => 'admin::app.admin.system.oldest-first',
              'value' => 'created_at-asc',
            ),
            4 => 
            array (
              'title' => 'admin::app.admin.system.cheapest-first',
              'value' => 'price-asc',
            ),
            5 => 
            array (
              'title' => 'admin::app.admin.system.expensive-first',
              'value' => 'price-desc',
            ),
          ),
          'channel_based' => true,
        ),
      ),
    ),
    26 => 
    array (
      'key' => 'catalog.products.review',
      'name' => 'admin::app.admin.system.review',
      'sort' => 3,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'guest_review',
          'title' => 'admin::app.admin.system.allow-guest-review',
          'type' => 'boolean',
        ),
      ),
    ),
    27 => 
    array (
      'key' => 'catalog.inventory',
      'name' => 'admin::app.admin.system.inventory',
      'sort' => 1,
    ),
    28 => 
    array (
      'key' => 'catalog.inventory.stock_options',
      'name' => 'admin::app.admin.system.stock-options',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'backorders',
          'title' => 'admin::app.admin.system.allow-backorders',
          'type' => 'boolean',
          'channel_based' => true,
        ),
      ),
    ),
    29 => 
    array (
      'key' => 'catalog.rich_snippets',
      'name' => 'admin::app.admin.system.rich-snippets',
      'sort' => 3,
    ),
    30 => 
    array (
      'key' => 'catalog.rich_snippets.products',
      'name' => 'admin::app.admin.system.products',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'enable',
          'title' => 'admin::app.admin.system.enable',
          'type' => 'boolean',
        ),
        1 => 
        array (
          'name' => 'show_sku',
          'title' => 'admin::app.admin.system.show-sku',
          'type' => 'boolean',
        ),
        2 => 
        array (
          'name' => 'show_weight',
          'title' => 'admin::app.admin.system.show-weight',
          'type' => 'boolean',
        ),
        3 => 
        array (
          'name' => 'show_categories',
          'title' => 'admin::app.admin.system.show-categories',
          'type' => 'boolean',
        ),
        4 => 
        array (
          'name' => 'show_images',
          'title' => 'admin::app.admin.system.show-images',
          'type' => 'boolean',
        ),
        5 => 
        array (
          'name' => 'show_reviews',
          'title' => 'admin::app.admin.system.show-reviews',
          'type' => 'boolean',
        ),
        6 => 
        array (
          'name' => 'show_ratings',
          'title' => 'admin::app.admin.system.show-ratings',
          'type' => 'boolean',
        ),
        7 => 
        array (
          'name' => 'show_offers',
          'title' => 'admin::app.admin.system.show-offers',
          'type' => 'boolean',
        ),
      ),
    ),
    31 => 
    array (
      'key' => 'catalog.rich_snippets.categories',
      'name' => 'admin::app.admin.system.categories',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'enable',
          'title' => 'admin::app.admin.system.enable',
          'type' => 'boolean',
        ),
        1 => 
        array (
          'name' => 'show_search_input_field',
          'title' => 'admin::app.admin.system.show-search-input-field',
          'type' => 'boolean',
        ),
      ),
    ),
    32 => 
    array (
      'key' => 'customer',
      'name' => 'admin::app.admin.system.customer',
      'sort' => 4,
    ),
    33 => 
    array (
      'key' => 'customer.settings',
      'name' => 'admin::app.admin.system.settings',
      'sort' => 1,
    ),
    34 => 
    array (
      'key' => 'customer.settings.address',
      'name' => 'admin::app.admin.system.address',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'street_lines',
          'title' => 'admin::app.admin.system.street-lines',
          'type' => 'text',
          'validation' => 'between:1,4',
          'channel_based' => true,
        ),
      ),
    ),
    35 => 
    array (
      'key' => 'customer.settings.newsletter',
      'name' => 'admin::app.admin.system.newsletter',
      'sort' => 2,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'subscription',
          'title' => 'admin::app.admin.system.newsletter-subscription',
          'type' => 'boolean',
        ),
      ),
    ),
    36 => 
    array (
      'key' => 'customer.settings.email',
      'name' => 'admin::app.admin.system.email',
      'sort' => 3,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'verification',
          'title' => 'admin::app.admin.system.email-verification',
          'type' => 'boolean',
        ),
      ),
    ),
    37 => 
    array (
      'key' => 'emails',
      'name' => 'admin::app.admin.emails.email',
      'sort' => 5,
    ),
    38 => 
    array (
      'key' => 'emails.general',
      'name' => 'admin::app.admin.emails.notification_label',
      'sort' => 1,
    ),
    39 => 
    array (
      'key' => 'emails.general.notifications',
      'name' => 'admin::app.admin.emails.notification_label',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'emails.general.notifications.verification',
          'title' => 'admin::app.admin.emails.notifications.verification',
          'type' => 'boolean',
        ),
        1 => 
        array (
          'name' => 'emails.general.notifications.registration',
          'title' => 'admin::app.admin.emails.notifications.registration',
          'type' => 'boolean',
        ),
        2 => 
        array (
          'name' => 'emails.general.notifications.customer',
          'title' => 'admin::app.admin.emails.notifications.customer',
          'type' => 'boolean',
        ),
        3 => 
        array (
          'name' => 'emails.general.notifications.new-order',
          'title' => 'admin::app.admin.emails.notifications.new-order',
          'type' => 'boolean',
        ),
        4 => 
        array (
          'name' => 'emails.general.notifications.new-admin',
          'title' => 'admin::app.admin.emails.notifications.new-admin',
          'type' => 'boolean',
        ),
        5 => 
        array (
          'name' => 'emails.general.notifications.new-invoice',
          'title' => 'admin::app.admin.emails.notifications.new-invoice',
          'type' => 'boolean',
        ),
        6 => 
        array (
          'name' => 'emails.general.notifications.new-refund',
          'title' => 'admin::app.admin.emails.notifications.new-refund',
          'type' => 'boolean',
        ),
        7 => 
        array (
          'name' => 'emails.general.notifications.new-shipment',
          'title' => 'admin::app.admin.emails.notifications.new-shipment',
          'type' => 'boolean',
        ),
        8 => 
        array (
          'name' => 'emails.general.notifications.new-inventory-source',
          'title' => 'admin::app.admin.emails.notifications.new-inventory-source',
          'type' => 'boolean',
        ),
        9 => 
        array (
          'name' => 'emails.general.notifications.cancel-order',
          'title' => 'admin::app.admin.emails.notifications.cancel-order',
          'type' => 'boolean',
        ),
      ),
    ),
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'database' => 'bg_save_24',
        'prefix' => '',
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'bg_save_24',
        'username' => 'root',
        'password' => '',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => 'InnoDB ROW_FORMAT=DYNAMIC',
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'bg_save_24',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'bg_save_24',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'predis',
      'default' => 
      array (
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 0,
      ),
    ),
  ),
  'db-blade-compiler' => 
  array (
    'model_property' => '__db_blade_compiler_content_field',
    'model_default_field' => 'content',
    'cache' => false,
  ),
  'debugbar' => 
  array (
    'enabled' => NULL,
    'except' => 
    array (
      0 => 'telescope*',
    ),
    'storage' => 
    array (
      'enabled' => true,
      'driver' => 'file',
      'path' => 'E:\\Xampp\\htdocs\\bg_save_24\\storage\\debugbar',
      'connection' => NULL,
      'provider' => '',
    ),
    'include_vendors' => true,
    'capture_ajax' => true,
    'add_ajax_timing' => false,
    'error_handler' => false,
    'clockwork' => false,
    'collectors' => 
    array (
      'phpinfo' => true,
      'messages' => true,
      'time' => true,
      'memory' => true,
      'exceptions' => true,
      'log' => true,
      'db' => true,
      'views' => true,
      'route' => true,
      'auth' => false,
      'gate' => true,
      'session' => true,
      'symfony_request' => true,
      'mail' => true,
      'laravel' => false,
      'events' => false,
      'default_request' => false,
      'logs' => false,
      'files' => false,
      'config' => false,
      'cache' => false,
      'models' => false,
    ),
    'options' => 
    array (
      'auth' => 
      array (
        'show_name' => true,
      ),
      'db' => 
      array (
        'with_params' => true,
        'backtrace' => true,
        'timeline' => false,
        'explain' => 
        array (
          'enabled' => false,
          'types' => 
          array (
            0 => 'SELECT',
          ),
        ),
        'hints' => true,
      ),
      'mail' => 
      array (
        'full_log' => false,
      ),
      'views' => 
      array (
        'data' => false,
      ),
      'route' => 
      array (
        'label' => true,
      ),
      'logs' => 
      array (
        'file' => NULL,
      ),
      'cache' => 
      array (
        'values' => true,
      ),
    ),
    'inject' => true,
    'route_prefix' => '_debugbar',
    'route_domain' => NULL,
  ),
  'discount-rules' => 
  array (
  ),
  'dompdf' => 
  array (
    'show_warnings' => false,
    'orientation' => 'portrait',
    'defines' => 
    array (
      'font_dir' => 'E:\\Xampp\\htdocs\\bg_save_24\\storage\\fonts/',
      'font_cache' => 'E:\\Xampp\\htdocs\\bg_save_24\\storage\\fonts/',
      'temp_dir' => 'C:\\Users\\Tanup\\AppData\\Local\\Temp',
      'chroot' => 'E:\\Xampp\\htdocs\\bg_save_24',
      'enable_font_subsetting' => false,
      'pdf_backend' => 'CPDF',
      'default_media_type' => 'screen',
      'default_paper_size' => 'a4',
      'default_font' => 'serif',
      'dpi' => 96,
      'enable_php' => false,
      'enable_javascript' => true,
      'enable_remote' => true,
      'font_height_ratio' => 1.1,
      'enable_html5_parser' => false,
    ),
  ),
  'excel' => 
  array (
    'exports' => 
    array (
      'chunk_size' => 1000,
      'pre_calculate_formulas' => false,
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'line_ending' => '
',
        'use_bom' => false,
        'include_separator_line' => false,
        'excel_compatibility' => false,
      ),
    ),
    'imports' => 
    array (
      'read_only' => true,
      'heading_row' => 
      array (
        'formatter' => 'slug',
      ),
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'escape_character' => '\\',
        'contiguous' => false,
        'input_encoding' => 'UTF-8',
      ),
    ),
    'extension_detector' => 
    array (
      'xlsx' => 'Xlsx',
      'xlsm' => 'Xlsx',
      'xltx' => 'Xlsx',
      'xltm' => 'Xlsx',
      'xls' => 'Xls',
      'xlt' => 'Xls',
      'ods' => 'Ods',
      'ots' => 'Ods',
      'slk' => 'Slk',
      'xml' => 'Xml',
      'gnumeric' => 'Gnumeric',
      'htm' => 'Html',
      'html' => 'Html',
      'csv' => 'Csv',
      'tsv' => 'Csv',
      'pdf' => 'Dompdf',
    ),
    'value_binder' => 
    array (
      'default' => 'Maatwebsite\\Excel\\DefaultValueBinder',
    ),
    'transactions' => 
    array (
      'handler' => 'db',
    ),
    'temporary_files' => 
    array (
      'local_path' => 'C:\\Users\\Tanup\\AppData\\Local\\Temp',
      'remote_disk' => NULL,
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'public',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => 'E:\\Xampp\\htdocs\\bg_save_24\\storage\\app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => 'E:\\Xampp\\htdocs\\bg_save_24\\storage\\app/public',
        'url' => 'https://127.0.0.1:8000/storage',
        'visibility' => 'public',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => NULL,
        'secret' => NULL,
        'region' => NULL,
        'bucket' => NULL,
        'url' => NULL,
      ),
    ),
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => 10,
    ),
    'argon' => 
    array (
      'memory' => 1024,
      'threads' => 2,
      'time' => 2,
    ),
  ),
  'image' => 
  array (
    'driver' => 'gd',
  ),
  'imagecache' => 
  array (
    'route' => 'cache',
    'paths' => 
    array (
      0 => 'E:\\Xampp\\htdocs\\bg_save_24\\storage\\app/public',
      1 => 'E:\\Xampp\\htdocs\\bg_save_24\\public\\storage',
    ),
    'templates' => 
    array (
      'small' => 'Webkul\\Product\\CacheFilters\\Small',
      'medium' => 'Webkul\\Product\\CacheFilters\\Medium',
      'large' => 'Webkul\\Product\\CacheFilters\\Large',
    ),
    'lifetime' => 43200,
  ),
  'jwt' => 
  array (
    'secret' => NULL,
    'keys' => 
    array (
      'public' => NULL,
      'private' => NULL,
      'passphrase' => NULL,
    ),
    'ttl' => 60,
    'refresh_ttl' => 20160,
    'algo' => 'HS256',
    'required_claims' => 
    array (
      0 => 'iss',
      1 => 'iat',
      2 => 'exp',
      3 => 'nbf',
      4 => 'sub',
      5 => 'jti',
    ),
    'persistent_claims' => 
    array (
    ),
    'lock_subject' => true,
    'leeway' => 0,
    'blacklist_enabled' => true,
    'blacklist_grace_period' => 0,
    'decrypt_cookies' => false,
    'providers' => 
    array (
      'jwt' => 'Tymon\\JWTAuth\\Providers\\JWT\\Lcobucci',
      'auth' => 'Tymon\\JWTAuth\\Providers\\Auth\\Illuminate',
      'storage' => 'Tymon\\JWTAuth\\Providers\\Storage\\Illuminate',
    ),
  ),
  'logging' => 
  array (
    'default' => 'stack',
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'single',
        ),
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => 'E:\\Xampp\\htdocs\\bg_save_24\\storage\\logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => 'E:\\Xampp\\htdocs\\bg_save_24\\storage\\logs/laravel.log',
        'level' => 'debug',
        'days' => 7,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'critical',
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
    ),
  ),
  'mail' => 
  array (
    'driver' => 'smtp',
    'host' => 'smtp.mailtrap.io',
    'port' => '2525',
    'from' => 
    array (
      'address' => '',
      'name' => '',
    ),
    'admin' => 
    array (
      'address' => '',
      'name' => 'Admin',
    ),
    'encryption' => 'tls',
    'stream' => 
    array (
      'ssl' => 
      array (
        'allow_self_signed' => true,
        'verify_peer' => false,
        'verify_peer_name' => false,
      ),
    ),
    'username' => '',
    'password' => '',
    'sendmail' => '/usr/sbin/sendmail -bs',
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => 'E:\\Xampp\\htdocs\\bg_save_24\\resources\\views/vendor/mail',
      ),
    ),
  ),
  'menu' => 
  array (
    'admin' => 
    array (
      0 => 
      array (
        'key' => 'velocity',
        'name' => 'velocity::app.admin.layouts.velocity',
        'route' => 'velocity.admin.content.index',
        'sort' => 5,
        'icon-class' => 'velocity-icon',
      ),
      1 => 
      array (
        'key' => 'velocity.meta-data',
        'name' => 'velocity::app.admin.layouts.meta-data',
        'route' => 'velocity.admin.meta-data',
        'sort' => 1,
        'icon-class' => '',
      ),
      2 => 
      array (
        'key' => 'velocity.header',
        'name' => 'velocity::app.admin.layouts.header-content',
        'route' => 'velocity.admin.content.index',
        'sort' => 2,
        'icon-class' => '',
      ),
      3 => 
      array (
        'key' => 'dashboard',
        'name' => 'admin::app.layouts.dashboard',
        'route' => 'admin.dashboard.index',
        'sort' => 1,
        'icon-class' => 'dashboard-icon',
      ),
      4 => 
      array (
        'key' => 'sales',
        'name' => 'admin::app.layouts.sales',
        'route' => 'admin.sales.orders.index',
        'sort' => 2,
        'icon-class' => 'sales-icon',
      ),
      5 => 
      array (
        'key' => 'sales.orders',
        'name' => 'admin::app.layouts.orders',
        'route' => 'admin.sales.orders.index',
        'sort' => 1,
        'icon-class' => '',
      ),
      6 => 
      array (
        'key' => 'sales.shipments',
        'name' => 'admin::app.layouts.shipments',
        'route' => 'admin.sales.shipments.index',
        'sort' => 2,
        'icon-class' => '',
      ),
      7 => 
      array (
        'key' => 'sales.invoices',
        'name' => 'admin::app.layouts.invoices',
        'route' => 'admin.sales.invoices.index',
        'sort' => 3,
        'icon-class' => '',
      ),
      8 => 
      array (
        'key' => 'sales.refunds',
        'name' => 'admin::app.layouts.refunds',
        'route' => 'admin.sales.refunds.index',
        'sort' => 4,
        'icon-class' => '',
      ),
      9 => 
      array (
        'key' => 'catalog',
        'name' => 'admin::app.layouts.catalog',
        'route' => 'admin.catalog.products.index',
        'sort' => 3,
        'icon-class' => 'catalog-icon',
      ),
      10 => 
      array (
        'key' => 'catalog.products',
        'name' => 'admin::app.layouts.products',
        'route' => 'admin.catalog.products.index',
        'sort' => 1,
        'icon-class' => '',
      ),
      11 => 
      array (
        'key' => 'catalog.categories',
        'name' => 'admin::app.layouts.categories',
        'route' => 'admin.catalog.categories.index',
        'sort' => 3,
        'icon-class' => '',
      ),
      12 => 
      array (
        'key' => 'catalog.attributes',
        'name' => 'admin::app.layouts.attributes',
        'route' => 'admin.catalog.attributes.index',
        'sort' => 2,
        'icon-class' => '',
      ),
      13 => 
      array (
        'key' => 'catalog.families',
        'name' => 'admin::app.layouts.attribute-families',
        'route' => 'admin.catalog.families.index',
        'sort' => 4,
        'icon-class' => '',
      ),
      14 => 
      array (
        'key' => 'customers',
        'name' => 'admin::app.layouts.customers',
        'route' => 'admin.customer.index',
        'sort' => 4,
        'icon-class' => 'customer-icon',
      ),
      15 => 
      array (
        'key' => 'customers.customers',
        'name' => 'admin::app.layouts.customers',
        'route' => 'admin.customer.index',
        'sort' => 1,
        'icon-class' => '',
      ),
      16 => 
      array (
        'key' => 'customers.groups',
        'name' => 'admin::app.layouts.groups',
        'route' => 'admin.groups.index',
        'sort' => 2,
        'icon-class' => '',
      ),
      17 => 
      array (
        'key' => 'customers.reviews',
        'name' => 'admin::app.layouts.reviews',
        'route' => 'admin.customer.review.index',
        'sort' => 3,
        'icon-class' => '',
      ),
      18 => 
      array (
        'key' => 'customers.subscribers',
        'name' => 'admin::app.layouts.newsletter-subscriptions',
        'route' => 'admin.customers.subscribers.index',
        'sort' => 4,
        'icon-class' => '',
      ),
      19 => 
      array (
        'key' => 'configuration',
        'name' => 'admin::app.layouts.configure',
        'route' => 'admin.configuration.index',
        'sort' => 7,
        'icon-class' => 'configuration-icon',
      ),
      20 => 
      array (
        'key' => 'settings',
        'name' => 'admin::app.layouts.settings',
        'route' => 'admin.locales.index',
        'sort' => 6,
        'icon-class' => 'settings-icon',
      ),
      21 => 
      array (
        'key' => 'settings.locales',
        'name' => 'admin::app.layouts.locales',
        'route' => 'admin.locales.index',
        'sort' => 1,
        'icon-class' => '',
      ),
      22 => 
      array (
        'key' => 'settings.currencies',
        'name' => 'admin::app.layouts.currencies',
        'route' => 'admin.currencies.index',
        'sort' => 2,
        'icon-class' => '',
      ),
      23 => 
      array (
        'key' => 'settings.exchange_rates',
        'name' => 'admin::app.layouts.exchange-rates',
        'route' => 'admin.exchange_rates.index',
        'sort' => 3,
        'icon-class' => '',
      ),
      24 => 
      array (
        'key' => 'settings.inventory_sources',
        'name' => 'admin::app.layouts.inventory-sources',
        'route' => 'admin.inventory_sources.index',
        'sort' => 4,
        'icon-class' => '',
      ),
      25 => 
      array (
        'key' => 'settings.channels',
        'name' => 'admin::app.layouts.channels',
        'route' => 'admin.channels.index',
        'sort' => 5,
        'icon-class' => '',
      ),
      26 => 
      array (
        'key' => 'settings.users',
        'name' => 'admin::app.layouts.users',
        'route' => 'admin.users.index',
        'sort' => 6,
        'icon-class' => '',
      ),
      27 => 
      array (
        'key' => 'settings.users.users',
        'name' => 'admin::app.layouts.users',
        'route' => 'admin.users.index',
        'sort' => 1,
        'icon-class' => '',
      ),
      28 => 
      array (
        'key' => 'settings.users.roles',
        'name' => 'admin::app.layouts.roles',
        'route' => 'admin.roles.index',
        'sort' => 2,
        'icon-class' => '',
      ),
      29 => 
      array (
        'key' => 'settings.sliders',
        'name' => 'admin::app.layouts.sliders',
        'route' => 'admin.sliders.index',
        'sort' => 7,
        'icon-class' => '',
      ),
      30 => 
      array (
        'key' => 'settings.taxes',
        'name' => 'admin::app.layouts.taxes',
        'route' => 'admin.tax-categories.index',
        'sort' => 8,
        'icon-class' => '',
      ),
      31 => 
      array (
        'key' => 'settings.taxes.tax-categories',
        'name' => 'admin::app.layouts.tax-categories',
        'route' => 'admin.tax-categories.index',
        'sort' => 1,
        'icon-class' => '',
      ),
      32 => 
      array (
        'key' => 'settings.taxes.tax-rates',
        'name' => 'admin::app.layouts.tax-rates',
        'route' => 'admin.tax-rates.index',
        'sort' => 2,
        'icon-class' => '',
      ),
      33 => 
      array (
        'key' => 'promotions',
        'name' => 'admin::app.layouts.promotions',
        'route' => 'admin.catalog-rules.index',
        'sort' => 5,
        'icon-class' => 'promotion-icon',
      ),
      34 => 
      array (
        'key' => 'promotions.catalog-rules',
        'name' => 'admin::app.promotions.catalog-rules.title',
        'route' => 'admin.catalog-rules.index',
        'sort' => 1,
        'icon-class' => '',
      ),
      35 => 
      array (
        'key' => 'promotions.cart-rules',
        'name' => 'admin::app.promotions.cart-rules.title',
        'route' => 'admin.cart-rules.index',
        'sort' => 2,
        'icon-class' => '',
      ),
      36 => 
      array (
        'key' => 'cms',
        'name' => 'admin::app.layouts.cms',
        'route' => 'admin.cms.index',
        'sort' => 5,
        'icon-class' => 'cms-icon',
      ),
      37 => 
      array (
        'key' => 'cms.pages',
        'name' => 'admin::app.cms.pages.pages',
        'route' => 'admin.cms.index',
        'sort' => 1,
        'icon-class' => '',
      ),
    ),
    'customer' => 
    array (
      0 => 
      array (
        'key' => 'account',
        'name' => 'shop::app.layouts.my-account',
        'route' => 'customer.profile.index',
        'sort' => 1,
      ),
      1 => 
      array (
        'key' => 'account.profile',
        'name' => 'shop::app.layouts.profile',
        'route' => 'customer.profile.index',
        'sort' => 1,
      ),
      2 => 
      array (
        'key' => 'account.address',
        'name' => 'shop::app.layouts.address',
        'route' => 'customer.address.index',
        'sort' => 2,
      ),
      3 => 
      array (
        'key' => 'account.reviews',
        'name' => 'shop::app.layouts.reviews',
        'route' => 'customer.reviews.index',
        'sort' => 3,
      ),
      4 => 
      array (
        'key' => 'account.wishlist',
        'name' => 'shop::app.layouts.wishlist',
        'route' => 'customer.wishlist.index',
        'sort' => 4,
      ),
      5 => 
      array (
        'key' => 'account.compare',
        'name' => 'velocity::app.customer.compare.text',
        'route' => 'velocity.customer.product.compare',
        'sort' => 5,
      ),
      6 => 
      array (
        'key' => 'account.orders',
        'name' => 'shop::app.layouts.orders',
        'route' => 'customer.orders.index',
        'sort' => 6,
      ),
      7 => 
      array (
        'key' => 'account.downloadables',
        'name' => 'shop::app.layouts.downloadable-products',
        'route' => 'customer.downloadable_products.index',
        'sort' => 7,
      ),
    ),
  ),
  'modules' => 
  array (
    'namespace' => 'Modules',
    'stubs' => 
    array (
      'enabled' => false,
      'path' => 'E:\\Xampp\\htdocs\\bg_save_24/vendor/nwidart/laravel-modules/src/Commands/stubs',
      'files' => 
      array (
        'start' => 'start.php',
        'routes' => 'Http/routes.php',
        'views/index' => 'Resources/views/index.blade.php',
        'views/master' => 'Resources/views/layouts/master.blade.php',
        'scaffold/config' => 'Config/config.php',
        'composer' => 'composer.json',
        'assets/js/app' => 'Resources/assets/js/app.js',
        'assets/sass/app' => 'Resources/assets/sass/app.scss',
        'webpack' => 'webpack.mix.js',
        'package' => 'package.json',
      ),
      'replacements' => 
      array (
        'start' => 
        array (
          0 => 'LOWER_NAME',
          1 => 'ROUTES_LOCATION',
        ),
        'routes' => 
        array (
          0 => 'LOWER_NAME',
          1 => 'STUDLY_NAME',
          2 => 'MODULE_NAMESPACE',
        ),
        'webpack' => 
        array (
          0 => 'LOWER_NAME',
        ),
        'json' => 
        array (
          0 => 'LOWER_NAME',
          1 => 'STUDLY_NAME',
          2 => 'MODULE_NAMESPACE',
        ),
        'views/index' => 
        array (
          0 => 'LOWER_NAME',
        ),
        'views/master' => 
        array (
          0 => 'LOWER_NAME',
          1 => 'STUDLY_NAME',
        ),
        'scaffold/config' => 
        array (
          0 => 'STUDLY_NAME',
        ),
        'composer' => 
        array (
          0 => 'LOWER_NAME',
          1 => 'STUDLY_NAME',
          2 => 'VENDOR',
          3 => 'AUTHOR_NAME',
          4 => 'AUTHOR_EMAIL',
          5 => 'MODULE_NAMESPACE',
        ),
      ),
      'gitkeep' => true,
    ),
    'paths' => 
    array (
      'modules' => 'E:\\Xampp\\htdocs\\bg_save_24\\Modules',
      'assets' => 'E:\\Xampp\\htdocs\\bg_save_24\\public\\modules',
      'migration' => 'E:\\Xampp\\htdocs\\bg_save_24\\database/migrations',
      'generator' => 
      array (
        'config' => 
        array (
          'path' => 'Config',
          'generate' => true,
        ),
        'command' => 
        array (
          'path' => 'Console',
          'generate' => true,
        ),
        'migration' => 
        array (
          'path' => 'Database/Migrations',
          'generate' => true,
        ),
        'seeder' => 
        array (
          'path' => 'Database/Seeders',
          'generate' => true,
        ),
        'factory' => 
        array (
          'path' => 'Database/factories',
          'generate' => true,
        ),
        'model' => 
        array (
          'path' => 'Entities',
          'generate' => true,
        ),
        'controller' => 
        array (
          'path' => 'Http/Controllers',
          'generate' => true,
        ),
        'filter' => 
        array (
          'path' => 'Http/Middleware',
          'generate' => true,
        ),
        'request' => 
        array (
          'path' => 'Http/Requests',
          'generate' => true,
        ),
        'provider' => 
        array (
          'path' => 'Providers',
          'generate' => true,
        ),
        'assets' => 
        array (
          'path' => 'Resources/assets',
          'generate' => true,
        ),
        'lang' => 
        array (
          'path' => 'Resources/lang',
          'generate' => true,
        ),
        'views' => 
        array (
          'path' => 'Resources/views',
          'generate' => true,
        ),
        'test' => 
        array (
          'path' => 'Tests',
          'generate' => true,
        ),
        'repository' => 
        array (
          'path' => 'Repositories',
          'generate' => false,
        ),
        'event' => 
        array (
          'path' => 'Events',
          'generate' => false,
        ),
        'listener' => 
        array (
          'path' => 'Listeners',
          'generate' => false,
        ),
        'policies' => 
        array (
          'path' => 'Policies',
          'generate' => false,
        ),
        'rules' => 
        array (
          'path' => 'Rules',
          'generate' => false,
        ),
        'jobs' => 
        array (
          'path' => 'Jobs',
          'generate' => false,
        ),
        'emails' => 
        array (
          'path' => 'Emails',
          'generate' => false,
        ),
        'notifications' => 
        array (
          'path' => 'Notifications',
          'generate' => false,
        ),
        'resource' => 
        array (
          'path' => 'Transformers',
          'generate' => false,
        ),
      ),
    ),
    'scan' => 
    array (
      'enabled' => false,
      'paths' => 
      array (
        0 => 'E:\\Xampp\\htdocs\\bg_save_24\\vendor/*/*',
      ),
    ),
    'composer' => 
    array (
      'vendor' => 'nwidart',
      'author' => 
      array (
        'name' => 'Nicolas Widart',
        'email' => 'n.widart@gmail.com',
      ),
    ),
    'cache' => 
    array (
      'enabled' => false,
      'key' => 'laravel-modules',
      'lifetime' => 60,
    ),
    'register' => 
    array (
      'translations' => true,
      'files' => 'register',
    ),
  ),
  'paymentmethods' => 
  array (
    'cashondelivery' => 
    array (
      'code' => 'cashondelivery',
      'title' => 'Cash On Delivery',
      'description' => 'Cash On Delivery',
      'class' => 'Webkul\\Payment\\Payment\\CashOnDelivery',
      'active' => true,
      'sort' => 1,
    ),
    'moneytransfer' => 
    array (
      'code' => 'moneytransfer',
      'title' => 'Money Transfer',
      'description' => 'Money Transfer',
      'class' => 'Webkul\\Payment\\Payment\\MoneyTransfer',
      'active' => true,
      'sort' => 2,
    ),
    'paypal_standard' => 
    array (
      'code' => 'paypal_standard',
      'title' => 'Paypal Standard',
      'description' => 'Paypal Standard',
      'class' => 'Webkul\\Paypal\\Payment\\Standard',
      'sandbox' => true,
      'active' => true,
      'business_account' => 'test@webkul.com',
      'sort' => 3,
    ),
  ),
  'pricerules' => 
  array (
  ),
  'product-types' => 
  array (
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => 'your-public-key',
        'secret' => 'your-secret-key',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'region' => 'us-east-1',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
      ),
    ),
    'failed' => 
    array (
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'repository' => 
  array (
    'pagination' => 
    array (
      'limit' => 15,
    ),
    'fractal' => 
    array (
      'params' => 
      array (
        'include' => 'include',
      ),
      'serializer' => 'League\\Fractal\\Serializer\\DataArraySerializer',
    ),
    'cache' => 
    array (
      'enabled' => false,
      'minutes' => 30,
      'repository' => 'cache',
      'clean' => 
      array (
        'enabled' => true,
        'on' => 
        array (
          'create' => true,
          'update' => true,
          'delete' => true,
        ),
      ),
      'params' => 
      array (
        'skipCache' => 'skipCache',
      ),
      'allowed' => 
      array (
        'only' => NULL,
        'except' => NULL,
      ),
    ),
    'criteria' => 
    array (
      'acceptedConditions' => 
      array (
        0 => '=',
        1 => 'like',
      ),
      'params' => 
      array (
        'search' => 'search',
        'searchFields' => 'searchFields',
        'filter' => 'filter',
        'orderBy' => 'orderBy',
        'sortedBy' => 'sortedBy',
        'with' => 'with',
        'searchJoin' => 'searchJoin',
        'withCount' => 'withCount',
      ),
    ),
    'generator' => 
    array (
      'basePath' => 'E:\\Xampp\\htdocs\\bg_save_24\\app',
      'rootNamespace' => 'App\\',
      'stubsOverridePath' => 'E:\\Xampp\\htdocs\\bg_save_24\\app',
      'paths' => 
      array (
        'models' => 'Entities',
        'repositories' => 'Repositories',
        'interfaces' => 'Repositories',
        'transformers' => 'Transformers',
        'presenters' => 'Presenters',
        'validators' => 'Validators',
        'controllers' => 'Http/Controllers',
        'provider' => 'RepositoryServiceProvider',
        'criteria' => 'Criteria',
      ),
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
    ),
    'ses' => 
    array (
      'key' => NULL,
      'secret' => NULL,
      'region' => 'us-east-1',
    ),
    'sparkpost' => 
    array (
      'secret' => NULL,
    ),
    'exchange-api' => 
    array (
      'default' => 'exchange_rates',
      'fixer' => 
      array (
        'key' => '',
        'class' => 'Webkul\\Core\\Helpers\\Exchange\\FixerExchange',
      ),
      'exchange_rates' => 
      array (
        'class' => 'Webkul\\Core\\Helpers\\Exchange\\ExchangeRates',
      ),
    ),
    'stripe' => 
    array (
      'model' => 'App\\User',
      'key' => NULL,
      'secret' => NULL,
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => '120',
    'expire_on_close' => true,
    'encrypt' => false,
    'files' => 'E:\\Xampp\\htdocs\\bg_save_24\\storage\\framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'bagisto_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => false,
    'http_only' => true,
    'same_site' => NULL,
  ),
  'themes' => 
  array (
    'default' => 'default',
    'themes' => 
    array (
      'default' => 
      array (
        'views_path' => 'resources/themes/default/views',
        'assets_path' => 'public/themes/default/assets',
        'name' => 'Default',
      ),
      'velocity' => 
      array (
        'views_path' => 'resources/themes/velocity/views',
        'assets_path' => 'public/themes/velocity/assets',
        'name' => 'Velocity',
        'parent' => 'default',
      ),
    ),
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
  'translatable' => 
  array (
    'locales' => 
    array (
      0 => 'en',
      1 => 'fr',
      'es' => 
      array (
        0 => 'MX',
        1 => 'CO',
      ),
    ),
    'locale_separator' => '-',
    'locale' => NULL,
    'use_fallback' => false,
    'use_property_fallback' => true,
    'fallback_locale' => 'en',
    'translation_model_namespace' => NULL,
    'translation_suffix' => 'Translation',
    'locale_key' => 'locale',
    'to_array_always_loads_translations' => true,
    'rule_factory' => 
    array (
      'format' => 1,
      'prefix' => '%',
      'suffix' => '%',
    ),
  ),
  'trustedproxy' => 
  array (
    'proxies' => NULL,
    'headers' => 30,
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => 'E:\\Xampp\\htdocs\\bg_save_24\\resources\\views',
    ),
    'compiled' => 'E:\\Xampp\\htdocs\\bg_save_24\\storage\\framework\\views',
  ),
  'product_types' => 
  array (
    'booking' => 
    array (
      'key' => 'booking',
      'name' => 'Booking',
      'class' => 'Webkul\\BookingProduct\\Type\\Booking',
      'sort' => 7,
    ),
    'simple' => 
    array (
      'key' => 'simple',
      'name' => 'Simple',
      'class' => 'Webkul\\Product\\Type\\Simple',
      'sort' => 1,
    ),
    'configurable' => 
    array (
      'key' => 'configurable',
      'name' => 'Configurable',
      'class' => 'Webkul\\Product\\Type\\Configurable',
      'sort' => 2,
    ),
    'virtual' => 
    array (
      'key' => 'virtual',
      'name' => 'Virtual',
      'class' => 'Webkul\\Product\\Type\\Virtual',
      'sort' => 3,
    ),
    'grouped' => 
    array (
      'key' => 'grouped',
      'name' => 'Grouped',
      'class' => 'Webkul\\Product\\Type\\Grouped',
      'sort' => 4,
    ),
    'downloadable' => 
    array (
      'key' => 'downloadable',
      'name' => 'Downloadable',
      'class' => 'Webkul\\Product\\Type\\Downloadable',
      'sort' => 5,
    ),
    'bundle' => 
    array (
      'key' => 'bundle',
      'name' => 'Bundle',
      'class' => 'Webkul\\Product\\Type\\Bundle',
      'sort' => 6,
    ),
  ),
);
