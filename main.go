package main

import (
	"log"
	"net/http"
)

func main() {
	http.Handle("/", http.FileServer(http.Dir("./static")))
	log.Println("listening on port 8080...")
	http.ListenAndServe(":8080", nil)
}
