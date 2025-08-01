<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings Profile Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'default-font': '#1a1a1a',
                        'subtext-color': '#666666',
                        'default-background': '#ffffff',
                        'neutral-border': '#e5e7eb',
                    }
                }
            }
        }
    </script>
    <style>
        /* Custom scrollbar for the profile section */
        .scrollable-profile {
            scrollbar-width: thin;
            scrollbar-color: #cbd5e0 #f1f5f9;
        }
        .scrollable-profile::-webkit-scrollbar {
            width: 8px;
        }
        .scrollable-profile::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        .scrollable-profile::-webkit-scrollbar-thumb {
            background-color: #cbd5e0;
            border-radius: 4px;
        }
    </style>
</head>