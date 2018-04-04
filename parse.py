import os
import sqlite3
from urllib.parse import urlparse


def parse(url):
    try:
        parse_url = urlparse(url)
        url_query = parse_url.query
        return url_query
    except IndexError:
        print("URL format error")


data_path: str = "{0}\\AppData\\Local\\Google\\Chrome\\User Data\\Default".format(os.path.expanduser('~'))
files = os.listdir(data_path)

history_db = os.path.join(data_path, 'history')
c = sqlite3.connect(history_db)
cursor = c.cursor()
select_statement = "SELECT url from urls"
cursor.execute(select_statement)
results = cursor.fetchall()
query_list = []
for url in results:
    x = parse(url)
    if x is '':
        continue
    elif x not in query_list:
        query_list.insert(x)
print(query_list)
