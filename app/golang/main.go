package main

import (
	"encoding/json"
	"fmt"
	"log"
	"net/http"
	"os"
)

// Define a struct to match the structure of your JSON data
type Item struct {
	ID    int    `json:"id"`
	Title string `json:"title"`
}

func main() {
	// Define a handler for the HTTP requests
	http.HandleFunc("/", func(w http.ResponseWriter, r *http.Request) {
		// Read the data.json file using os.ReadFile
		data, err := os.ReadFile("data.json")
		if err != nil {
			http.Error(w, "Error reading data.json", http.StatusInternalServerError)
			return
		}

		// Parse JSON data into a slice of Item
		var items []Item
		if err := json.Unmarshal(data, &items); err != nil {
			http.Error(w, "Error parsing JSON", http.StatusInternalServerError)
			return
		}

		// Set the content type to JSON
		w.Header().Set("Content-Type", "application/json")

		// Respond with the JSON representation of the items
		jsonResponse, err := json.Marshal(items)
		if err != nil {
			http.Error(w, "Error marshaling JSON", http.StatusInternalServerError)
			return
		}

		w.Write(jsonResponse)
	})

	// Start the HTTP server
	fmt.Println("Starting server at port 8101...")
	if err := http.ListenAndServe(":8101", nil); err != nil {
		log.Fatal(err)
	}
}
