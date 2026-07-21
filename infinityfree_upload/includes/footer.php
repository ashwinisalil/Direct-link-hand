<!--
    FOOTER - included at the BOTTOM of every page.
    Closes the tags opened in header.php and loads the JS file.
-->
    <footer class="site-footer">
        <div class="container">
            <!-- date('Y') always prints the current year automatically -->
            <p>&copy; <?= date('Y') ?> Direct Link Hands. All rights reserved.</p>
            <p><a href="/DirectLinkHands/about.php">About</a> | <a href="/DirectLinkHands/contact.php">Contact</a></p>
        </div>
    </footer>

    <!-- Loaded at the end of the page so it doesn't block content from showing first -->
    <script src="/DirectLinkHands/js/script.js"></script>
</body>
</html>
