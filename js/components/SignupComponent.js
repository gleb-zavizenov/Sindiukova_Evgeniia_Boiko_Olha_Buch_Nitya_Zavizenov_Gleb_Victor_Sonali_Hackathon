export default{
    template: `
        <form class="cathedral-form" action="./includes/admin/sign-up.php" method="POST">
            <label>First Name:</label>
            <input type='text' name="first_name" id="first_name" required>
            <label>Last Name:</label>
            <input type='text' name="last_name" id="last_name" required>
            <label>Email Adress:</label>
            <input type='email' name="email" id="email" required>
            <label>Country:</label>
            <input type='text' name="country" id="country" required>
            <button class="round-button" name="submit">Submit</button>
        </form>
        `
}