<?php
// database/seeders/RolePermissionSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Create permissions for all sections
        $permissions = [
            // System Management Permissions
            'view_users',
            'create_users',
            'edit_users',
            'delete_users',
            'view_roles',
            'manage_roles',
            'view_departments',
            'create_departments',
            'edit_departments',
            'delete_departments',
            'manage_system_settings',

            // Employee Management Permissions
            'view_employees',
            'create_employees',
            'edit_employees',
            'delete_employees',
            'view_employee_statuses',
            'manage_employee_statuses',
            'view_foreigners',
            'manage_foreigners',
            'view_palestinians',
            'manage_palestinians',

            // Organizational Structure Permissions
            'view_faculties',
            'manage_faculties',
            'view_majors',
            'manage_majors',
            'view_positions',
            'manage_positions',
            'view_cities',
            'manage_cities',
            'view_regions',
            'manage_regions',
            'view_universities',
            'manage_universities',

            // Certificates and Qualifications Permissions
            'view_certificate_types',
            'manage_certificate_types',
            'view_certificate_specializations',
            'manage_certificate_specializations',
            'view_certificate_countries',
            'manage_certificate_countries',
            'view_certificates',
            'manage_certificates',

            // Training and Courses Permissions
            'view_iust_courses_intitled',
            'manage_iust_courses_intitled',
            'view_iust_courses',
            'manage_iust_courses',
            'view_taught_courses',
            'manage_taught_courses',
            'view_courses',
            'manage_courses',

            // Events and Communication Permissions
            'view_events',
            'manage_events',
            'view_life_events',
            'manage_life_events',
            'view_contacts',
            'manage_contacts',
            'view_contact_types',
            'manage_contact_types',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo($permissions);

        $departmentHeadRole = Role::create(['name' => 'department_head']);
        $departmentHeadRole->givePermissionTo([
            // System Management (limited)
            // 'view_users',
            // 'create_users',
            // 'edit_users',
            // 'view_departments',
            // 'create_departments',
            // 'edit_departments',

            // Employee Management
            'view_employees',
            'create_employees',
            'edit_employees',
            'view_employee_statuses',
            'manage_employee_statuses',
            'view_foreigners',
            'manage_foreigners',
            'view_palestinians',
            'manage_palestinians',

            // Organizational Structure
            'view_faculties',
            'manage_faculties',
            'view_majors',
            'manage_majors',
            'view_positions',
            'manage_positions',
            'view_cities',
            'manage_cities',
            'view_regions',
            'manage_regions',
            'view_universities',
            'manage_universities',

            // Certificates and Qualifications
            'view_certificate_types',
            'manage_certificate_types',
            'view_certificate_specializations',
            'manage_certificate_specializations',
            'view_certificate_countries',
            'manage_certificate_countries',
            'view_certificates',
            'manage_certificates',

            // Training and Courses
            'view_iust_courses_intitled',
            'manage_iust_courses_intitled',
            'view_iust_courses',
            'manage_iust_courses',
            'view_taught_courses',
            'manage_taught_courses',
            'view_courses',
            'manage_courses',

            // Events and Communication
            'view_events',
            'manage_events',
            'view_life_events',
            'manage_life_events',
            'view_contacts',
            'manage_contacts',
            'view_contact_types',
            'manage_contact_types',
        ]);

        // $professorRole = Role::create(['name' => 'professor']);
        // $studentRole = Role::create(['name' => 'student']);
    }
}