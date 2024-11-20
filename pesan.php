<form method="POST" action="actions/send_message.php">
    <label for="sender_id">ID Pengirim:</label>
    <input type="text" id="sender_id" name="sender_id" required>

    <label for="receiver_id">ID Penerima:</label>
    <input type="text" id="receiver_id" name="receiver_id" required>

    <label for="message">Pesan:</label>
    <textarea id="message" name="message" required></textarea>

    <button type="submit">Kirim Pesan</button>
</form>
