from selenium import webdriver
from bs4 import BeautifulSoup
import time
import json
import sys
import os


def scrape(SOLD_START_DATE, SOLD_END_DATE, SUBDIVISION, CITY):
    # SOLD_START_DATE = '01/01/2016'
    # SOLD_END_DATE = '12/31/2016'
    # SUBDIVISION = 'Castle Hills'
    # CITY = 'Lewisville'

    # inputs
    OUTPUT_DIR = os.getcwd() + '\scrapes' #'C:/Users/bsapaka/Documents/Other/dfwtr'

    LOGIN_USERNAME = '0501010'
    LOGIN_PASSWORD = 'Winter16'
    URL_MATRIX = 'http://matrix.ntreis.net/Matrix/Search/Residential/Quick'


    driver = webdriver.Chrome('chromedriver.exe')

    # LOGIN
    ELEM_ID_USERNAME = 'j_username'
    ELEM_ID_PASSWORD = 'password'
    ELEM_ID_LOGIN = 'loginbtn'
    ELEM_XPATH_END_TOUR = '//*[@id="step-0"]/div[3]/button'
    ELEM_XPATH_MATRIX = '//*[@id="appColumn17"]/div/img'

    driver.get(URL_MATRIX)

    time.sleep(1)

    driver.find_element_by_id(ELEM_ID_USERNAME).send_keys(LOGIN_USERNAME)
    driver.find_element_by_id(ELEM_ID_PASSWORD).click()

    time.sleep(1)
    driver.find_element_by_id(ELEM_ID_PASSWORD).send_keys(LOGIN_PASSWORD)
    driver.find_element_by_id(ELEM_ID_LOGIN).click()

    time.sleep(4)


    # CRITERIA PAGE
    ELEM_NAME_ACTIVE_CHECKBOX = 'Fm1036_Ctrl37_LB'
    ELEM_NAME_SOLD_CHECKBOX = 'Fm1036_Ctrl37_LB'
    ELEM_NAME_SOLD_TEXTBOX = 'FmFm1036_Ctrl37_104_Ctrl37_TB'
    ELEM_NAME_SUBDIVISION_TEXTBOX = 'Fm1036_Ctrl1129_TextBox'
    ELEM_ID_CITY_TEXTBOX = 'Fm1036_Ctrl39_LB_TB'
    ELEM_XPATH_GET_RESULTS = '//*[@id="m_ucSearchButtons_m_lbSearch"]/span'

    driver.get(URL_MATRIX)

    time.sleep(2)

    driver.find_element_by_name(ELEM_NAME_SOLD_CHECKBOX).click()
    driver.find_element_by_name(ELEM_NAME_SOLD_TEXTBOX).click()
    driver.find_element_by_name(ELEM_NAME_SOLD_TEXTBOX).send_keys(SOLD_START_DATE + '-' + SOLD_END_DATE)

    driver.find_element_by_name(ELEM_NAME_SUBDIVISION_TEXTBOX).click()
    driver.find_element_by_name(ELEM_NAME_SUBDIVISION_TEXTBOX).send_keys('*' + SUBDIVISION + '*')

    driver.find_element_by_id(ELEM_ID_CITY_TEXTBOX).click()
    driver.find_element_by_id(ELEM_ID_CITY_TEXTBOX).send_keys(CITY)

    driver.find_element_by_xpath(ELEM_XPATH_GET_RESULTS).click()

    # RESULTS PAGE
    ELEM_ID_STATS_BUTTON = 'm_btnStats'
    ELEM_ID_TABULAR_BUTTON = 'm_lbOldStats'

    time.sleep(2)

    driver.find_element_by_id(ELEM_ID_STATS_BUTTON).click()
    time.sleep(.4)
    driver.find_element_by_id(ELEM_ID_TABULAR_BUTTON).click()

    # DATA TABLE PAGE
    ELEM_ID_DATA_TABLE_CONTAINER = 'StatsDIV'

    html = driver.find_element_by_id(ELEM_ID_DATA_TABLE_CONTAINER).get_attribute('innerHTML')

    # DATA TABLE TO DICTIONARY
    data = []

    data.append(CITY)
    data.append(SUBDIVISION)
    data.append(SOLD_START_DATE)
    data.append(SOLD_END_DATE)

    soup = BeautifulSoup(html, 'lxml')
    # table = soup.find('table', attrs={'class':'lineItemsTable'})
    table_body = soup.find('tbody')

    rows = table_body.find_all('tr')
    for row in rows:
        cols = row.find_all('td')
        cols = [ele.text.strip() for ele in cols]
        data.append([ele for ele in cols])

    json_data = json.dumps(data)

    sd = SOLD_START_DATE.replace("/", "")
    ed = SOLD_END_DATE.replace("/", "")
    export_filename = CITY + '_' + SUBDIVISION + '_' + sd + '_thru_' + ed + '_ts' + str(time.time()) + '.json'
    export_path = OUTPUT_DIR + "/" + export_filename


    f = open(export_path, 'w')
    f.write(json_data)
    f.close()

    driver.close()