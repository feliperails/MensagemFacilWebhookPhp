<?php
$inputJSON = file_get_contents('php://input');
$listInput = json_decode($inputJSON);

$pdo = new PDO('mysql:host=localhost;dbname=mf_webhook_test', 'root_mf_webhook_test', '03VO1HKG9k4$');

foreach ($listInput as $input) {
    $statement = $pdo->prepare("INSERT INTO ChatMessage(
            WhatsAppNumberId, From, To, Timestamp, Content, Caption, Type, Mimetype, hash
        ) VALUES (
            :WhatsAppNumberId, :From, :To, :Timestamp, :Content, :Caption, :Type, :Mimetype, :hash
        )");
    $statement->bindParam(':WhatsAppNumberId', $input->WhatsAppNumberId);
    $statement->bindParam(':From', $input->Data->From);
    $statement->bindParam(':To', $input->Data->To);
    $statement->bindParam(':Timestamp', $input->Data->Timestamp);
    $statement->bindParam(':Content', $input->Data->Content);
    $statement->bindParam(':Caption', $input->Data->Caption);
    $statement->bindParam(':Type', $input->Data->Type);
    $statement->bindParam(':Mimetype', $input->Data->Mimetype);
    $statement->bindParam(':hash', $input->Data->hash);

    $statement->execute();
}