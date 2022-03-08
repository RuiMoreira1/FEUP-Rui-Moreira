from collections import defaultdict

def emptyBucket(Bucket):
    if Bucket > 0:
        return 0
    else:
        return Bucket

def fillBucket(Bucket, BucketMaxCapacity):
    if Bucket < BucketMaxCapacity:
        return BucketMaxCapacity
    else:
        return Bucket
    
def pourB1toB2(Bucket1, Bucket2):
    if Bucket1 + Bucket2 >= 3 and Bucket2 < 3:
        return Bucket1 - (3-Bucket2), 3
    elif Bucket1 + Bucket2 < 3 and Bucket1 > 0:
        return 0, Bucket2 + Bucket1
    
def pourB2toB1(Bucket2, Bucket1):
    if Bucket2 + Bucket1 >= 4 and Bucket1 < 4:
        return 4, Bucket2- (4-Bucket1)
    elif Bucket2 + Bucket1 < 4 and Bucket2 > 0:
        return Bucket2+Bucket1,0

jug1, jug2, aim = 4, 3, 2
  

visited = defaultdict(lambda: False)
  
def waterBucketSolver(amt1, amt2): 

    if (amt1 == aim and amt2 == 0):
        print(amt1, amt2)
        return True
      
    if visited[(amt1, amt2)] == False:
        print(amt1, amt2)
    
        visited[(amt1, amt2)] = True
      
        return (waterBucketSolver(0, amt2) or waterBucketSolver(amt1, 0) or
                waterBucketSolver(jug1, amt2) or waterBucketSolver(amt1, jug2) or
                waterBucketSolver(amt1 + min(amt2, (jug1-amt1)),
                amt2 - min(amt2, (jug1-amt1))) or
                waterBucketSolver(amt1 - min(amt1, (jug2-amt2)),
                amt2 + min(amt1, (jug2-amt2))))
    
    else:
        return False
  
print("Steps: ")
  
waterBucketSolver(0, 0)