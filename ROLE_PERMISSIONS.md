# Role-Based Permission System

This application now includes a simple role-based permission system that controls what users can see and do.

## Available Roles

### Admin
- **Full access** to all features including user management
- Can manage users, roles, and permissions
- Has access to all modules and reports

### Manager
- Can manage products, orders, purchases, quotations, customers, suppliers
- Can view reports and dashboard
- Cannot manage users or system settings

### Sales
- Can manage orders, quotations, and customers
- Has access to dashboard
- Perfect for sales team members

### Inventory
- Can manage products, purchases, suppliers, categories, and units
- Has access to dashboard
- Perfect for inventory management staff

### Viewer
- Read-only access to dashboard and reports
- Cannot create, edit, or delete anything
- Perfect for stakeholders who need visibility

## How to Assign Roles

### Using the Web Interface
1. Login as an admin user
2. Go to Management > User Roles
3. Select a user and assign them a role from the dropdown
4. Click "Assign Role"

### Using Command Line
```bash
php artisan user:assign-role user@example.com manager
php artisan user:assign-role user@example.com sales
php artisan user:assign-role user@example.com inventory
php artisan user:assign-role user@example.com viewer
```

## Navigation Changes
The navigation menu now automatically shows/hides items based on user permissions:
- Users only see menu items they have permission to access
- Dashboard buttons (like "Create new order") only appear for users with appropriate permissions
- This keeps the interface clean and prevents confusion

## Testing the System
1. Create test users with different roles
2. Login as each user to see how the interface changes
3. Try accessing restricted URLs directly - you should get a 403 error
4. The system maintains all existing functionality while adding permission controls

## Permissions Overview
- `view-dashboard` - Access to main dashboard
- `manage-products` - Full product management
- `manage-orders` - Full order management
- `manage-purchases` - Full purchase management
- `manage-quotations` - Full quotation management
- `manage-customers` - Full customer management
- `manage-suppliers` - Full supplier management
- `manage-categories` - Category management
- `manage-units` - Unit management
- `view-reports` - Access to reports
- `manage-users` - User and role management

The system is designed to be simple and effective - each user gets exactly the access they need for their role without overwhelming them with unnecessary options.