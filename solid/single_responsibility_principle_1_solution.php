<?php

class Invoice {
    private array $items = [];

    public function addItem(string $name, float $price): void {
        $this->items[] = ['name' => $name, 'price' => $price];
    }

    public function getItems(): array {
        return $this->items;
    }

    public function getTotal(): float {
        return array_sum(array_column($this->items, 'price'));
    }
}

class InvoicePrinter {
    public function toText(Invoice $invoice): string {
        $output = "Invoice:\n";

        foreach ($invoice->getItems() as $item) {
            $output .= $item['name'] . ": $" . $item['price'] . "\n";
        }

        $output .= "Total: $" . $invoice->getTotal() . "\n";

        return $output;
    }
}

class InvoiceSaver {
    public function saveToFile(string $filename, Invoice $invoice, InvoicePrinter $printer): void {
        file_put_contents($filename, $printer->toText($invoice));
    }
}

// --- Example usage ---
$invoice = new Invoice();
$invoice->addItem("Laptop", 1200);
$invoice->addItem("Mouse", 25);

$printer = new InvoicePrinter();
$saver = new InvoiceSaver();

$saver->saveToFile("invoice.txt", $invoice, $printer);

