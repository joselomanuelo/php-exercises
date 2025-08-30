<?php

class Invoice {
    private array $items = [];

    public function addItem(string $name, float $price): void {
        $this->items[] = ['name' => $name, 'price' => $price];
    }

    public function getTotal(): float {
        return array_sum(array_column($this->items, 'price'));
    }

    // ❌ This method is responsible for formatting the invoice as text
    public function toText(): string {
        $output = "Invoice:\n";
        foreach ($this->items as $item) {
            $output .= $item['name'] . ": $" . $item['price'] . "\n";
        }
        $output .= "Total: $" . $this->getTotal() . "\n";
        return $output;
    }

    // ❌ This method is responsible for saving the invoice to a file
    public function saveToFile(string $filename): void {
        file_put_contents($filename, $this->toText());
    }
}

$invoice = new Invoice();
$invoice->addItem("Laptop", 1200);
$invoice->addItem("Mouse", 25);
$invoice->saveToFile("invoice.txt");

/*
EXERCISE (Single Responsibility Principle - SRP):

Right now, the class Invoice is doing THREE different things:
1. It manages invoice items and calculates the total.
2. It formats the invoice as text.
3. It saves the invoice to a file.

⚠️ This violates SRP because a class should have ONLY ONE reason to change.

👉 Your task:
- Refactor the code into SEPARATE classes.
- One class should handle the invoice data and total calculation.
- One class should handle formatting/printing.
- One class should handle saving to a file.

After refactoring, each class must have ONLY ONE responsibility.
*/


