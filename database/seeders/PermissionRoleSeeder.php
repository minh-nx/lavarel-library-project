<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionRoleSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        // create permissions
        $manageAccountsPermission = Permission::create(['name' => 'accounts.manage']);
        $manageRolesPermission = Permission::create(['name' => 'roles.manage']);
        $managePermissionsPermission = Permission::create(['name' => 'permissions.manage']);

        $accessAdminPagesPermission = Permission::create(['name' => 'access admin pages']);
        $createBooksPermission = Permission::create(['name' => 'books.create']);
        $readBooksPermission = Permission::create(['name' => 'books.read']);
        $updateBooksPermission = Permission::create(['name' => 'books.update']);
        $deleteBooksPermission = Permission::create(['name' => 'books.delete']);
        $createBooktypesPermission = Permission::create(['name' => 'booktypes.create']);
        $readBooktypesPermission = Permission::create(['name' => 'booktypes.read']);
        $updateBooktypesPermission = Permission::create(['name' => 'booktypes.update']);
        $deleteBooktypesPermission = Permission::create(['name' => 'booktypes.delete']);
        $sendNotificationsPermission = Permission::create(['name' => 'notifications.send']);

        $accessClientPagesPermission = Permission::create(['name' => 'access client pages']);
        $searchBooksPermission = Permission::create(['name' => 'books.search']);
        $readBorrowBooksPermission = Permission::create(['name' => 'books.borrows.read']);
        $createBorrowBooksPermission = Permission::create(['name' => 'books.borrows.create']);
        $updateBorrowBooksPermission = Permission::create(['name' => 'books.borrows.update']);
        $deleteBorrowBooksPermission = Permission::create(['name' => 'books.borrows.delete']);
        $createFeedbacksPermission = Permission::create(['name' => 'feedbacks.create']);
        $readFeedbacksPermission = Permission::create(['name' => 'feedbacks.read']);
        $updateFeedbacksPermission = Permission::create(['name' => 'feedbacks.update']);
        $deleteFeedbacksPermission = Permission::create(['name' => 'feedbacks.delete']);

        $superadminPermissions = [
            $manageAccountsPermission,
            $manageRolesPermission,
            $managePermissionsPermission,
        ];

        $adminPermissions = [
            $accessAdminPagesPermission,
            $createBooksPermission,
            $readBooksPermission,
            $updateBooksPermission,
            $deleteBooksPermission,
            $createBooktypesPermission,
            $readBooktypesPermission,
            $updateBooktypesPermission,
            $deleteBooktypesPermission,
            $sendNotificationsPermission,

            $searchBooksPermission,
            $readBorrowBooksPermission,
            $updateBorrowBooksPermission,
            $deleteBorrowBooksPermission,
        ];

        $clientPermissions = [
            $accessClientPagesPermission,
            $searchBooksPermission,
            $createBorrowBooksPermission,
            $readBorrowBooksPermission,
            $updateBorrowBooksPermission,
            $deleteBorrowBooksPermission,
            $createFeedbacksPermission,
            $readFeedbacksPermission,
            $updateFeedbacksPermission,
            $deleteFeedbacksPermission,

            $readBooksPermission,
            $readBooktypesPermission,
        ];

        // create roles
        $clientRole = Role::findOrCreate('client');
        $adminRole = Role::findOrCreate('admin');
        $superadminRole = Role::findOrCreate('super admin');

        // assign permissions to roles
        $clientRole->syncPermissions($clientPermissions);
        $adminRole->syncPermissions($adminPermissions);
        $superadminRole->syncPermissions($superadminPermissions);
    }
}
