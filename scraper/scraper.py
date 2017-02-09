from scrape import scrape

from cities import *

for city, subdivisions in cities.items():
    for subdivision in subdivisions:
        scrape('01/01/2016', '12/31/2016', subdivision, city)
        # scrape '01/01/2016' '12/31/2016'
