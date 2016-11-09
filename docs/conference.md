Spec:

* rzuca wyjątek w przypadku nie podania numeru rezerwacji
* rzuca wyjątek przy drugiej próbie wywołania tej samej akcji na rezerwacji
* poprawnie anuluje rezerwacje gdy parametry są dobre
* anuluje rezerwację z listy oczekujących
* zwiększa ilość wolnych miejsc przy pustej liście oczekujących
* zmniejsza ilość wolnych miejsc gdy otrzyma rezerwację z listy oczekujących
* przenosi rezerwacje z pustej listy (?)