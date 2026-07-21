DirectLinkHands - InfinityFree upload package

1. In InfinityFree File Manager, open htdocs.
2. Upload the CONTENTS of this folder into htdocs (not the folder itself).
3. In phpMyAdmin, select database if0_42443922_directlinkhands.
4. Import database/directlinkhands.sql.
5. Open https://directlinkhands.page.gd/ and test registration, login, contact, and document upload.

The upload package is already configured with the supplied InfinityFree database:
Host: sql302.infinityfree.com
User: if0_42443922
Database: if0_42443922_directlinkhands

The reset_admin_password.php helper was intentionally excluded. The SQL file contains a placeholder admin hash;
create an organization/user normally, and if admin access is required, use a temporary local reset or replace the
admin password hash in phpMyAdmin with a password_hash() result. Never upload a password-reset script to production.

Keep the uploads folder writable and do not remove its .htaccess file.
